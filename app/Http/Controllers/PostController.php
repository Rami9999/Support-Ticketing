<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Log;

class PostController extends Controller
{
    public function index()
    {
        $categories = Category::
        whereHas('posts',function($query){
            $query->published();
        })
        ->take(10)->get();

        return view('posts.index',[
            'categories' =>$categories ,
        ]);
    }

    public function show(Post $post)
    {

        return view('posts.show',[
            'post' =>$post ,
        ]);
    }
}
