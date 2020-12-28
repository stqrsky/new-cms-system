<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function show(Post $post) {     // routeModelbinding , inject Post class

        return view('blog-post', ['post' => $post]);
    }

}
