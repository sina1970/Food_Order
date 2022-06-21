<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request){
//        foreach ($request->food_id as $item) {
//            $test= Test::insert([
//                'order_id' => $request->order_id,
//                'food_id' => $item
//            ]);
//       }
////       return response()->json($test);
//        $input =$request->except('_token');
//        return response($input);
//        $data = json_decode(json_encode($input),true);
//        $res = Test::insert($data);
//        return $res;
//        foreach ($request->food_id as $item){
//            $test= Test::insert([
//                'order_id' => $request->order_id,
//                'food_id' => $item
//            ]);
//        }
        $arr = array(['order_id'=>1,'food_id'=>40],["order_id"=>1,"food_id"=>60],["order_id"=>1,"food_id"=>70]);
        $test = Test::insert($arr);
        return response($test);
    }
}
