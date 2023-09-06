<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function addComment(Request $request)
    {
        $post = Post::findOrFail($request->input('postId'));
        $comment = $request->input('message');

        $post->addComment([
            'message' => $comment,
        ]);

        return $comment;
    }
}
