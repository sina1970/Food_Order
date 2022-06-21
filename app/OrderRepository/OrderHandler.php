<?php

namespace App\OrderRepository;

use App\Models\Food;
use App\Models\FoodOrder;
use App\Models\Test;
use Illuminate\Support\Facades\DB;

class OrderHandler
{
    public static function GetPrice ($data){
        return DB::table('foods')->whereIn('id',$data)->sum('price');
    }

    public static function GetCookTime($data){
        return DB::table('foods')->whereIn('id',$data)->max('cook_time');
    }

    public static function SaveFoodOrder($data, $id){
//        $foodsName = DB::table('foods')->select('name')->whereIn('id',$data)->get('name');
//        $foodsName = explode(",",$foodsName);
//        dd($foodsName);
//        return $foodsName;
        $food_order_array=array();
        foreach ($data as $temp){
            $test=[
                "food_id" => $temp,
                "order_id" => $id,
            ];
            array_push($food_order_array,$test);
        }
        FoodOrder::insert($food_order_array);
    }

    public static function GetOrdersList(){

    }

    public static function SpecificOrder($id){
//        dd($id);
        $order = DB::table('food_order')
            ->join('foods', 'foods.id','=','food_order.food_id')
            ->join('orders','orders.id','=','food_order.order_id')
            ->select('foods.name as food_name')
            ->where('orders.id','=',$id)
            ->get();
        return self::convertToArray($order);

    }

    public static function convertToArray($data){
        $tempArr = array();
        foreach ($data as $temp){
            array_push($tempArr, $temp->food_name);
        }
        return $tempArr;
    }
}
