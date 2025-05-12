<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BlogResource;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $blogs = \App\Models\Blog::all();
        return BlogResource::collection($blogs);
    }
}
