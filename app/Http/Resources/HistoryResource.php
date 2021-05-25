<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Models\Relation;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->preparing();

        return [
            'type'               => $this->histories_type,
            'date'               => $this->histories->date,
            'document_reference' => $this->histories->for,
            'description'        => $this->description,
            'location'           => $this->rack->code,

            'in'            => ($this->type ?? $this->histories->type) == 'DEBIT' ? $this->quantity : 0,
            'out'           => ($this->type ?? $this->histories->type) == 'CREDIT' ? $this->quantity : 0,
        ];
    }

    /**
     * 
     */
    public function preparing(): void
    {
        switch ($this->histories_type) {

            case 'Delivery':
                $company = Relation::find($this->histories->description);
                $this->description = 'Delivery to <b> ' . ($company->name ?? '_____') . '</b>';
                break;

            case 'Initialisation':
                $this->description = 'Opening Balance';
                break;

            case 'JobCost':
                $this->description = '<b> ' . ($this->histories->description ?? 'Doesn\'t have reason') . '</b>';
                break;

            case 'Adjustment':
                $this->adjustType();
                $this->description = '<b> ' . ($this->histories->description ?? 'Doesn\'t have note') . '</b>';
                break;

            case 'Receive':
                $company = Relation::find($this->histories->description);
                $this->description = 'Receive from <b> ' . ($company->name ?? '_____') . '</b>';
                break;

            case 'Release':
                $product = Product::find($this->histories->description);
                $this->description = 'Release Material for Production <b> ' . ($product->name ?? '_____') . '</b>';
                break;

            case 'Result':
                $this->description = '<b> Production Result </b>';
                break;

            default:
                $this->description = $this->histories_type . ' (' . $this->histories->description . ')';
                break;
        }
    }

    /**
     * 
     */
    public function adjustType(): void
    {
        if ($this->quantity < 0) {
            $this->type     = 'CREDIT';
            $this->quantity *= -1;
        }
    }
}
