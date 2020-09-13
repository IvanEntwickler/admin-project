<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //////// INDEX
    public function index(){
        // only the users posts
        $posts = auth()->user()->posts()->paginate(5);

        // $posts = Post::all();

        return view('admin.posts.index', ['posts'=>$posts]);
    }
    //////// CREATE + STORE
    public function create(){
        // $this->authorize('create', Post::class);
        return view('admin.posts.create');
    }
    public function store(Request $request){
        // dd(request()->all());
        // $user = Auth::user();
        /// validation of $inputs
        $inputs = request()->validate([
            'title'=> 'required | min:8 | max:255',
            'body'=>'required',
            'post_image'=>'file',
        ]);
        /// if the user puts in an image file the inputs gets
        // assigned to the request image and stored into and images folder
        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
        }
        // create a post of $inputs for an authtenicated user
        auth()->user()->posts()->create($inputs);
        // prints out a message once the post was created
        $request->session()->flash('post-created-message',
        'Post '.
        '<<'.$inputs['title'].'>>'.
        ' from ' .
        '<<'.auth()->user()->name.'>>'.
        ' was successfully created! '
        );
        return redirect()->route('post.index');
    }
    //////// SHOW
    public function show(Post $post){
        return view('blog-post', ['post'=>$post]);
    }

    //////// EDIT
    public function edit(Post $post){
        // editting only possible for the owner of the post
        // $this->authorize('view', $post);
        return view('admin.posts.edit', ['post'=>$post]);
    }

    //////// UPDATE
    public function update(Request $request, Post $post){

        $updateInputs = request()->validate([
            'title'=> 'required | min:8 | max:255',
            'body'=>'required',
            'post_image'=>'file',
        ]);
        /// if the user puts in an image file the inputs gets
        // assigned to the request image and stored into and images folder
        if(request('post_image')){
            $updateInputs['post_image'] = request('post_image')->store('images');
        }
        $post->title = $updateInputs['title'];
        $post->body = $updateInputs['body'];
        // update a post of $updateInputs for the authtenicated user
        // and save it for the authtenticated user
        // auth()->user()->posts()->save($post);

        /// calling policiy from PostPolicy.php to
        /// only let the user change the post if the user_id of the post is matching
        // $this->authorize('update', $post);
        //just saving the post for the original user
        $post->save();
        // prints out a message once the post was updated
        $request->session()->flash('post-updated-message',
        'Post with title: '.
        '<<'.$updateInputs['title'].'>>'.
        ' from ' .
        '<<'.auth()->user()->name.'>>'.
        ' was successfully updated! '
        );
        return redirect()->route('post.index');
    }

    //////// DELETE
    public function destroy(Request $request, Post $post){
        // $this->authorize('delete', $post);
        $post->delete();
        // prints out a message once the post was deleted
        $request->session()->flash('message', 'Post at Id ' . $post->id . ' was successfully deleted!');
        // Session::flash('message', 'Post at Id ' . $post->id . ' was successfully deleted!');
        return back();
    }
}
