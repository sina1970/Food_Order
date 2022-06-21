<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'order_id' => $this->id,
            'Type' => 'Order',
            'Data' => [
                'client_id' => $this->client_id,
                'price' => $this->price,
                'address' => $this->address,
                'phone' => $this->phone,
                'verify' => $this->verify,
                'cook_time' => $this->cook_time,
                'food_name' => $this->foods_name
            ],
        ];
    }
}
