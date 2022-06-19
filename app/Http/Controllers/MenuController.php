<?php

namespace App\Http\Controllers;

use App\Http\Resources\FoodsResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class MenuController extends Controller
{
    public function showMenu($id){
        try {
            $category = Category::find($id);
            return FoodsResource::collection($category->food);
        }catch (\Throwable $e){
            throw new HttpException(500, $e->getMessage());
        }
    }
}
