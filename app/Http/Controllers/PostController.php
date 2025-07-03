<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.pages.post');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'text' => 'required',
        ]);

        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $image->storeAs('post', $imageName);

        Post::create([
            'user_id' => Auth::id(),
            'image' => $imageName,
            'text' => $request->text
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function addComment(Request $request)
    {
        $validate = $request->validate([
            'post_id' => 'required|exists:posts,post_id',
            'text' => 'required',
        ]);

        $comment = Comment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'comment' => $request->text, // Field di database adalah 'comment', bukan 'text'
        ]);

        // Load user relation untuk response
        $comment->load('user');

        return response()->json([
            'success' => true,
            'comment' => [
                'comment_id' => $comment->comment_id,
                'comment' => $comment->comment,
                'user' => [
                    'name' => $comment->user->name
                ]
            ]
        ]);
    }

    public function like(Request $request, Post $post)
    {
        $userId = Auth::id();

        // Check if user already liked this post
        $existingLike = Like::where('post_id', $post->post_id)
            ->where('user_id', $userId)
            ->first();

        if ($existingLike) {
            // Unlike: delete the like
            $existingLike->delete();
            $isLiked = false;
        } else {
            // Like: create new like
            Like::create([
                'post_id' => $post->post_id,
                'user_id' => $userId,
            ]);
            $isLiked = true;
        }

        // Get updated like count
        $likeCount = $post->likes()->count();

        return response()->json([
            'success' => true,
            'is_liked' => $isLiked,
            'like_count' => $likeCount
        ]);
    }
}
