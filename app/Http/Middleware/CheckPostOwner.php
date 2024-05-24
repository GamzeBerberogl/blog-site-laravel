<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CheckPostOwner
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $post = Post::findOrFail($request->route('post'));

        if ($post->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'You are not authorized to perform this action.');
        }

        return $next($request);
    }
}
