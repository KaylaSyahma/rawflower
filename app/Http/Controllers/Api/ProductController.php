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

    // buat nampilin yang popular aj
    public function popular(){
        try {
            $popularProduct = Product::with('category', 'productImages')
                -> where('popular', true)
                -> get();
            
            return ProductResource::collection($popularProduct);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function showDetail($id){
        $product = Product::with(['category', 'productImages', 'colors'])->findOrFail($id);
        return new ProductResource($product);     
    }
}
