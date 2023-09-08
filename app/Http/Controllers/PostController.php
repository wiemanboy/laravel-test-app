<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\PostsResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

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

        $this->checkIfAllowed($post);

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

        $this->checkIfAllowed($post);

        $post->delete();

        return PostResource::make($post);
    }

    public function getPosts(Request $request): AnonymousResourceCollection
    {
        $query = Post::with('user')
            ->where('is_private', false);

        if ($request->has('status') && $request->input('status') !== null ) {
            $query->where('status', $request->input('status'));
        }

        if ($request->has('owner')) {
            $query->whereHas('user', function ($query) use ($request) {
                $query->where('username', 'like', '%' . $request->input('owner') . '%');
            });
        }

        if ($request->has('caption')) {
            $query->where('caption', 'like', '%' . $request->input('caption') . '%');
        }

        if ($request->has('order_by')) {
            $query->orderBy($request->input('order_by'), $request->input('order'));
        }

        return PostsResource::collection($query->paginate($request->input('per_page', 15)));
    }

    private function checkIfAllowed($post):void {
        if (! Gate::allows('update-post', $post)) {
            abort(403);
        }
    }
}
