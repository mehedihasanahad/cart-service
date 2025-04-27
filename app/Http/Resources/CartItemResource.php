<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CartItemResource
 *
 * Transforms cart item data into a JSON-friendly format.
 */
class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_id' => $this->service_id,
            'cart_id' => $this->cart_id,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'price' => $this->price,
        ];
    }
}
