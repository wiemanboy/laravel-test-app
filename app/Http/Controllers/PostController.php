<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/*
 * Controller is Controller, same as in spring/.NET
 */

class PostController extends Controller
{
    public function createPost(Request $request): Post
    {
        return Post::create([
            'caption' => $request->input('caption')
        ]);
    }

    public function getPost(int $id): PostResource
    {
        $test = Post::findOrFail($id);

        return PostResource::make($test);
    }

    public function updatePost(int $id, Request $request): Post
    {
        $test = Post::findOrFail($id);
        $test->update([
            'caption' => $request->input('caption'),
            'is_private' => $request->input('isPrivate')
        ]);
        $test->save();
        return $test;
    }

    public function deletePost(int $id): Post
    {
        $test = Post::findOrFail($id);
        $test->delete();
        return $test;
    }

    public function addComment(int $id, Request $request): Post
    {
        $test = Post::findOrFail($id);

        $test->addComment([
            'message' => $request->input('message'),
        ]);

        return $test;
    }
}
