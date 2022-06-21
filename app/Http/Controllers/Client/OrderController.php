<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\OrderRepository\OrderHandler;
use App\OrderRepository\OrderConvertor;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $food_price = OrderHandler::GetPrice($request->food_id);
        $cook_time = OrderHandler::GetCookTime($request->food_id);
        try {

            $order = Order::create([
                'client_id' => $request->client_id,
                'price' => $food_price,
                'address' => $request->address,
                'phone' => $request->phone,
                'verify' => 0,
                'cook_time' => $cook_time
            ]);
            OrderHandler::SaveFoodOrder($request->food_id, $order->id);
//            return OrderHandler::SaveFoodOrder($request->food_id, $order->id);
            $food_names= OrderHandler::SpecificOrder($order->id);

//            array_push($order,["foods"=>$food_names]);
//            $modelData = OrderHandler::SpecificOrder($order->id);
//            dd();
            return new OrderResource(new OrderConvertor($order, $food_names));
        }catch (\Throwable $e){
//            throw new HttpException(500, $e->getMessage());
            return response($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return response($order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

}
