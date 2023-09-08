<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function addComment(Request $request)
    {
        $comment = new Comment([
            'user_id' => $request->user()->id,
            'message' => $request->input('message'),
        ]);

        if (!$comment->isAppropriate()) {
            return response()->json(['message' => 'Comment is not appropriate'], 400);
        }

        $post = Post::findOrFail($request->input('post_id'));

        $post->addComment($comment);

        return CommentResource::make($comment);
    }
}
