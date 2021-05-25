<?php

namespace App\Imports;

use App\Models\Adjustment;
use App\Models\Product;
use App\Models\Rack;
use App\Models\Warehouse;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Events\ImportFailed;

class AdjustmentStocktaking implements ToCollection, WithHeadingRow, WithEvents, WithChunkReading, ShouldQueue
{
    use Importable, RemembersChunkOffset;

    protected $adjustment, $date;

    protected $count;

    public function __construct(Carbon $date, Adjustment $adjustment)
    {
        $this->date = $date->format('Y-m-d');

        $this->adjustment = $adjustment;
        $this->adjustment->products()->sync([]);
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {

            $this->storeProgress();

            $product = Product::where('name', $row['product_name'])->first();

            if ($product) {

                $rack        = $this->getRackId($row['location'], $row['warehouse']);
                $rackHistory = $rack->load(['history' => function ($q) use ($product) {
                    return $q->where('product_id', $product->id)->with(['histories' => function ($q) {
                        $q->where('date', '<=', $this->date);
                    }]);
                }]);

                $quantity = $row['actual_quantity'] - $rack->getQuantity($rackHistory->history);

                if ($quantity != 0) {
                    $this->adjustment->products()->attach([
                        $product->id => [
                            'quantity'  => $quantity,
                            'rack_id'   => $rack->id
                        ]
                    ]);
                }
            }
        }

        if ($this->getChunkOffset() >= $this->count['Worksheet']) {
            $this->adjustment->update(['status' => 'Upload Completed']);
        }
    }

    /**
     * 
     */
    public function chunkSize(): int
    {
        return 10;
    }

    /**
     * 
     */
    public function getWarehouseId(string $warehouse): int
    {
        return Warehouse::firstOrCreate([
            'name' => $warehouse
        ])->id;
    }

    /**
     * 
     */
    public function getRackId(string $rack, string $warehouse): Rack
    {
        return Rack::firstOrCreate([
            'code' => $rack
        ], [
            'warehouse_id' => $this->getWarehouseId($warehouse)
        ]);
    }

    /** 
     * 
     */
    public function storeProgress()
    {
        $percent = $this->getChunkOffset() / $this->count['Worksheet'] * 100;
        $this->adjustment->update(['status' => 'Processing Upload...(' . round($percent, 0) . '%)']);
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            // Handle by a closure.
            BeforeImport::class => function (BeforeImport $event) {
                $this->count = $event->reader->getTotalRows();
            },

            ImportFailed::class => function (ImportFailed $event) {
                $this->adjustment->update(['status' => 'Upload Failed']);
            },
        ];
    }
}
