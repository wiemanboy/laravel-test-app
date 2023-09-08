<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function addComment(Request $request)
    {
        $comment = new Comment([
            'user_id' => $request->user()->id,
            'message' => $request->input('message'),
        ]);

        if (!$comment->isAppropriate()) {
            abort(400);
        }

        $post = Post::findOrFail($request->input('post_id'));

        $this->checkIfAllowed($post);

        $post->addComment($comment);

        return CommentResource::make($comment);
    }

    private function checkIfAllowed($post): void
    {
        if (!Gate::allows('access-post', $post)) {
            abort(403);
        }
    }
}
