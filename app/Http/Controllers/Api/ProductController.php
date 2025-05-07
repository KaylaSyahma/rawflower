<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::with('category')->get();
        return ProductResource::collection($products);
    }

    public function showDetail($id){
        $product = Product::with(['category', 'productImages', 'colors'])->findOrFail($id);
        return new ProductResource($product);     
    }
}
