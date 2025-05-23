<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CustomResource;
use App\Models\CustomBow;
use App\Models\CustomFlower;
use App\Models\CustomPaper;
use Illuminate\Http\Request;

class CustomController extends Controller
{
    public function index()
    {
        $flowers = CustomResource::collection(CustomFlower::all());
        $bows = CustomResource::collection(CustomBow::all());
        $papers = CustomResource::collection(CustomPaper::all());

        return response()->json([
            'flowers' => $flowers,
            'bows' => $bows,
            'papers' => $papers,
        ]);
    }
}
