<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use http\Env\Response;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
 * Controller is Controller, same as in spring/.NET
 */

class PostController extends Controller
{
    public function createPost(Request $request): PostResource
    {
        $user = Auth::user();

        $post = Post::create([
            'user_id' => $user->getAuthIdentifier(),
            'caption' => $request->input('caption'),
            'message' => $request->input('message'),
            'is_private' => $request->input('is_private'),
            'status' => $request->input('status'),
        ]);

        return PostResource::make($post);
    }

    public function getPost(int $id): PostResource
    {
        $post = Post::findOrFail($id);

        return PostResource::make($post);
    }

    public function updatePost(int $id, Request $request): PostResource
    {
        $post = Post::findOrFail($id);
        $post->update([
            'caption' => $request->input('caption'),
            'message' => $request->input('message'),
            'is_private' => $request->input('is_private'),
            'status' => $request->input('status'),
        ]);
        $post->save();

        return PostResource::make($post);
    }

    public function deletePost(int $id): PostResource
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return PostResource::make($post);
    }
}
