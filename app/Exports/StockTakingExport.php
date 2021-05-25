<?php

namespace App\Exports;

use App\Models\Product;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;


class StockTakingExport implements FromCollection, WithHeadings, WithMapping, WithStrictNullComparison, ShouldAutoSize
{
    use Exportable;

    protected $date;

    public function __construct(Carbon $date)
    {
        $this->date = $date->format('Y-m-d');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $results = collect();

        // Put data into Collection
        Product::with('racks.warehouse')->chunk(100, function ($products) use ($results) {
            foreach ($products as $product) {
                foreach ($product->racks->unique('code') as $rack) {
                    $rackWithHistory = $rack->load(['history' => function ($q) use ($product) {
                        return $q->where('product_id', $product->id)->with(['histories' => function ($q) {
                            $q->where('date', '<=', $this->date);
                        }]);
                    }]);

                    $results->push([
                        'product_name'          => $product->name,
                        'product_description'   => $product->description,
                        'warehouse'             => $rack->warehouse->name,
                        'location'              => $rack->code,
                        'quantity'              => $rack->getQuantity($rackWithHistory->history)
                    ]);
                }
            }
        });
        return $results;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Product Name',
            'Description',
            'Warehouse',
            'Location',
            'Actual Quantity'
        ];
    }

    /**
     * @var Product $product
     */
    public function map($item): array
    {
        return [
            $item['product_name'],
            $item['product_description'],
            $item['warehouse'],
            $item['location'],
            $item['quantity']
        ];
    }
}
