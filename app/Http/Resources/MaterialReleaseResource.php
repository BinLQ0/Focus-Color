<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MaterialReleaseResource extends JsonResource
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
            'id'            => $this->id,
            'date'          => $this->date,
            'for'           => $this->for,
            'description'   => $this->endProduct->name ?? null,
            'used'          => $this->whenLoaded('products', function () {
                return $this->products->sum('pivot.quantity');
            }),
            'isClosed'      => $this->result ? true : false
        ];
    }
}
