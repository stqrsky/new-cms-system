<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function show(Post $post) {     // routeModelbinding , inject Post class

        return view('blog-post', ['post' => $post]);
    }

    public function create() {     // routeModelbinding , inject Post class

        return view('admin.posts.create');
    }

    public function store() {

        $inputs = request()->validate([
            'title' => 'required | min:3 | max:255',
            'post_image' => 'file',
            'body' => 'required'
        ]);

        if(request('post_image')) {                                         // if post_image is available
            $inputs['post_image'] = request('post_image')->store('images'); // then we grab $input array and put it in there, = grab from request... and store it in images folder
        }

    }

}
