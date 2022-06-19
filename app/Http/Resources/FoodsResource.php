<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpKernel\Exception\HttpException;

class FoodsResource extends JsonResource
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
            'id' => $this->id,
            'Type' => 'Foods',
            'data' => [
                'name' => $this->name,
                'amount' => $this->amount,
                'cook_time' => $this->cook_time,
                'price' => $this->price,
                'category_id' => $this->category_id
            ],
        ];


    }
}
