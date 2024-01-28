<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;



class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:edit-post,post')->only('edit', 'update');
    }

    // public function index()
    // {
    //     $posts = Post::with('author'')->get();
    //     return view('home')->with('posts',$posts);
    // }
    public function index()
    {
        $posts = Post::with('author')->latest()->get();
        return view('home')->with('posts',$posts);
    }


    // public function create()
    // {
    // return view('newpost');
    // }


    //     public function store(Request $request)
    // {
    //     // Validate the request data
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'body' => 'required|string',
    //         // Add other validation rules if needed
    //     ]);

    //     // Create a new post
    //     $post = new Post([
    //         'title' => $request->input('title'),
    //         'body' => $request->input('body'),
    //         // Add other fields if needed
    //     ]);

    //     // Save the post
    //     $post->save();

    //     // Redirect back to the dashboard or any other page
    //     return redirect()->route('home')->with('success', 'Post created successfully');
    // }

    public function create()
    {
        $users = User::all(); // Assuming you have a User model in the App\Models namespace
        return view('newpost', ['users' => $users]);
    }

    // ...

    public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string',
        'author' => 'required|exists:users,id',
        'slug' => 'required|string', // Ensure the selected author exists in the users table
        // Add other validation rules if needed
    ]);

    // Create a new post
    $authorId = Auth::id();
    $post = new Post([
        'title' => $request->input('title'),
        'body' => $request->input('body'),
        'author' => $authorId,
        'slug' => $request->input('slug'),  // Generate slug from title
        // Add other fields if needed
    ]);

    // Save the post
    $post->save();

    // Redirect back to the dashboard or any other page
    return redirect()->route('home')->with('success', 'Post created successfully');
}

}
