<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    
    public function index() {

        $posts = auth()->user()->posts;                   // use this ->posts syntax like a property to get a collection, instead of posts()

        //PAGINATION
        $posts = auth()->user()->posts()->paginate(5);       //  chaining methods, we need to keep chaining methods



        return view('admin.posts.index', ['posts' => $posts]);
    }


    public function show(Post $post) {     // routeModelbinding , inject Post class

        return view('blog-post', ['post' => $post]);
    }

    public function create() {     // routeModelbinding , inject Post class


        // authorize - if we authorize this save then we can proceed
        $this->authorize('create', Post::class); 

        return view('admin.posts.create');
    }

    public function store() {

        // authorize - if we authorize this save then we can proceed
        $this->authorize('create', Post::class); 

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

        $this->authorize('view', $post);            //authorize( "THE POSTPOLICY.PHP FUNCTION", MODEL-INSTANZ)

        // if(auth()->user()->can('view', $post)) {

        // }

        return view('admin.posts.edit', ['post' => $post]);
    }


    public function destroy (Post $post, Request $request) {
        
        // if(auth()->user()->id !== $post->user_id)..  // alternative

        // authorize - if we authorize this destroy then we can proceed
        $this->authorize('delete', $post); 

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

        // authorize - if we authorize this update then we can proceed
        $this->authorize('update', $post);     

        // auth()->user()->posts()->save($post);
        // $post->save();
        $post->update();

        session()->flash('post-updated-message', 'Post with title was updated : ' . $inputs['title']);

        return redirect()->route('post.index');
    }

}
