<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'post_id'     => $this->post_id,
            'title'       => optional($this->post)->title,
            'sale_price'  => $this->sale_price,
            'cost_price'  => $this->cost_price,
            'photo'       => $this->photo
        ];
    }
}
