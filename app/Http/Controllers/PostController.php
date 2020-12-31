<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    
    public function index() {

        $posts = Post::all();
        return view('admin.posts.index', ['posts' => $posts]);
    }


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

        auth()->user()->posts()->create($inputs);

        session()->flash('post-created-message', 'Post with title was created : ' . $inputs['title']);
        return redirect()->route('post.index');
    }


    public function edit(Post $post) {
        return view('admin.posts.edit', ['post' => $post]);
    }


    public function destroy (Post $post, Request $request) {
        $post->delete();

        $request->session()->flash('message', 'Post was deleted');

        return back();
    }

    public function update(Post $post) {
        $inputs = request()->validate([
            'title' => 'required | min:3 | max:255',
            'post_image' => 'file',
            'body' => 'required'
        ]);

        if(request('post_image')) {                                         // if post_image is available
            $inputs['post_image'] = request('post_image')->store('images'); // then we grab $input array and put it in there, = grab from request... and store it in images folder
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        // auth()->user()->posts()->save($post);
        // $post->save();
        $post->update();

        session()->flash('post-updated-message', 'Post with title was updated : ' . $inputs['title']);

        return redirect()->route('post.index');
    }

}
