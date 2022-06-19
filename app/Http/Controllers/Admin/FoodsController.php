<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FoodRequest;
use App\Http\Resources\FoodsResource;
use App\Models\Food;
use Symfony\Component\HttpKernel\Exception\HttpException;
use function response;
use function tap;

class FoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return FoodsResource::collection(Food::all());
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FoodRequest $request)
    {
        $request->validated();
        try {
            $food = Food::create([
                'name' => $request->name,
                'amount' => $request->amount,
                'cook_time' => $request->cook_time,
                'price' => $request->price,
                'category_id' => $request->category_id
            ]);
            return new FoodsResource($food);
        }catch (\Throwable $e){
            throw new HttpException(500, $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $food = Food::find($id);
            if (!is_null($food)){
                return new FoodsResource($food);
            }
        }catch (\Throwable $e){
            throw new HttpException(500, $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FoodRequest $request, $id)
    {
        try {
            $food = tap(Food::where('id',$id))
                ->update([
                    'name' => $request->name,
                    'amount' => $request->amount,
                    'cook_time' => $request->cook_time,
                    'price' => $request->price,
                    'category_id' => $request->category_id
                ])->first();
            return new FoodsResource($food);
        }catch (\Throwable $e){
            throw new HttpException(500, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $food = Food::find($id);
            $food->delete();
            return response()->json("food with id {$id} deleted");
        }catch (\Throwable $e){
            throw new HttpException(500, $e->getMessage());
        }

    }
}
