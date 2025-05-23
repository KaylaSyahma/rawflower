<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
{
    $blogs = Blog::latest()->get();

    return response()->json($blogs);
}

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return response()->json($blog);
    }
}