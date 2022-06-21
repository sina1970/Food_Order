<?php

namespace App\OrderRepository;

class OrderConvertor
{
    public $id;
    public $client_id;
    public $price;
    public $address;
    public $phone;
    public $verify;
    public $cook_time;
    public $foods_name;

    public function __construct($obj, $arr){
        $this->id = $obj->id;
        $this->client_id = $obj->client_id;
        $this->price = $obj->price;
        $this->address = $obj->address;
        $this->phone = $obj->phone;
        $this->verify = $obj->verify;
        $this->cook_time = $obj->cook_time;
        $this->foods_name = $arr;
    }
}
