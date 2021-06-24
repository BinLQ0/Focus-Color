<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'code'      => $this->code . ' ( ' . $this->warehouse->name . ' ) ',
            'note'      => $this->note,
            'quantity'  => $this->when(request('stock', false), function () {
                return $this->getQuantity($this->history);
            })
        ];
    }
}
