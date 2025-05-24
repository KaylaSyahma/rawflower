<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CustomResource;
use App\Models\CategoryFlower;
use App\Models\CustomBow;
use App\Models\CustomFlower;
use App\Models\CustomPaper;
use Illuminate\Http\Request;

class CustomController extends Controller
{
    public function index()
    {
        $flowerCategories = CategoryFlower::with('flowers')->get();
        $flowerData = [];

        foreach ($flowerCategories as $category) {
            // Gunakan nama kategori sebagai key, bisa juga lowercase atau snake_case kalau mau konsisten
            $flowerData[$category->nama] = CustomResource::collection($category->flowers);
        }

        return response()->json([
            'flowers' => $flowerData, // ini nested object
            'bows' => CustomResource::collection(CustomBow::all()),
            'papers' => CustomResource::collection(CustomPaper::all()),
        ]);
    }
}
