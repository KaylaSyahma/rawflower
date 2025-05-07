<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        // ngasih nama nya data
        $data = Category::all();
        return CategoryResource::collection($data);
    }

    public function show(Category $category){
        $category->load('products');
        // Kalau data ketemu, bungkus datanya pake Resource (biar bentuk responsenya rapi & konsisten)
        return new CategoryResource($category);
    }
}
