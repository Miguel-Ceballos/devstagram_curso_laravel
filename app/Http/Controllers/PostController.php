<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        // Except agrega los métodos que sí son accesibles para usuarios no autenticados.
        $this->middleware('auth')->except('show', 'index');
    }

    public function index(User $user)
    {

//        $posts = Post::where('user_id', $user->id)->paginate(2);

        return view('posts.index', [
            'user' => $user,
            'posts' => $user->posts
//            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => [ 'required', 'min:1', 'max:50' ],
            'body' => [ 'required', 'min:1', 'max:255' ],
            'image' => [ 'required' ]
        ]);

//        Post::create([
//            'user_id' => auth()->user()->id,
//            'title' => $request->title,
//            'body' => $request->body,
//            'image' => $request->image
//        ]);

        $request->user()->posts()->create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'body' => $request->body,
            'image' => $request->image
        ]);

        return redirect()->route('dashboard', auth()->user()->username);

    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'user' => $user,
            'post' => $post
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        // Delete image
        $img_path = public_path('uploads/' . $post->image);
        if ( File::exists($img_path) ) {
            unlink($img_path);
        }

        return redirect()->route('dashboard', auth()->user()->username);

    }

}
