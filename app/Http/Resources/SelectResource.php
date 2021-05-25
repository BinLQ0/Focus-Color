<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SelectResource extends JsonResource
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
            'text'      => $this->name,
            'selected'  => $this->when($request->has('selected'), function () use ($request) {
                return ($request->selected == $this->id) ? true : false;
            })
        ];
    }
}
