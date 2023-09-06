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
    public function createPost(Request $request): Post
    {
        return Post::create([
            'caption' => $request->input('caption'),
            'message' => $request->input('message'),
            'is_private' => $request->input('isPrivate'),
            'status' => $request->input('status'),
        ]);
    }

    public function getPost(int $id): PostResource
    {
        $post = Post::findOrFail($id);

        return PostResource::make($post);
    }

    public function updatePost(int $id, Request $request): Post
    {
        $post = Post::findOrFail($id);
        $post->update([
            'caption' => $request->input('caption'),
            'message' => $request->input('message'),
            'is_private' => $request->input('isPrivate'),
            'status' => $request->input('status'),
        ]);
        $post->save();

        return $post;
    }

    public function deletePost(int $id): Post
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return $post;
    }
}
