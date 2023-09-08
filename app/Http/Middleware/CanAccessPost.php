<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/*
 * A class that modifies a request before it reaches the controller.
 */

class CanAccessPost
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $post = Post::find($request->route('id'));

        if (Auth::user()->getAuthIdentifier() === $post->user_id) {
            return $next($request);
        }
        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
