<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

/*
 * Controller is Controller, same as in spring/.NET
 */

class PostController extends Controller
{
    public function createPost(Request $request): PostResource
    {
        $post = Post::create([
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
