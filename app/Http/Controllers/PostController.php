<?php

namespace App\Http\Controllers;

use App\Mail\NewPostNotification;
use App\Models\Post;
use App\Models\Category;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category', 'user')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
        ]);

        // Abonelere mail gönderme
        $subscribers = Subscriber::all();
        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new NewPostNotification($post));
        }

        return redirect()->route('home')->with('status', 'Post created successfully!');
    }
    
    public function postsByCategory($id)
    {
        $category = Category::findOrFail($id);
        $posts = Post::where('category_id', $id)->with('category', 'user')->paginate(10);
        return view('posts.index', compact('posts', 'category'));
    }

    public function show($id)
    {
        $post = Post::with('category', 'user')->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function myPosts()
    {
        $posts = Post::where('user_id', Auth::id())->paginate(10);
        return view('posts.my-post', compact('posts'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();

        // Kullanıcının kendi postunu düzenlemesi için yetki kontrolü
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'You are not authorized to edit this post.');
        }

        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post = Post::findOrFail($id);

        // Kullanıcının kendi postunu güncellemesi için yetki kontrolü
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'You are not authorized to update this post.');
        }

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('home')->with('status', 'Post updated successfully!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Kullanıcının kendi postunu silmesi için yetki kontrolü
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'You are not authorized to delete this post.');
        }

        $post->delete();

        return redirect()->route('home')->with('status', 'Post deleted successfully!');
    }
}
