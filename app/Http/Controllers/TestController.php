<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index($id){
        $category = Category::find($id);
//        dd($category->food);
        return response()->json($category->food);
//        dd($category);
    }
}
