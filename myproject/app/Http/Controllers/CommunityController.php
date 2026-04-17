<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Save;

class CommunityController extends Controller
{
public function index()
{
    $publicPosts = Post::with(['user', 'comments.user'])
        ->withCount('likes')
        ->with(['likes' => function($q){
            $q->where('user_id', auth()->id());
        }])
        ->latest()
        ->get();

    $myPosts = Post::with(['user', 'comments.user'])
        ->withCount('likes')
        ->with(['likes' => function($q){
            $q->where('user_id', auth()->id());
        }])
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    // 🔥 SAVED POSTS
$savedPosts = Post::with(['user', 'comments.user'])
    ->withCount('likes')
    ->whereIn('post_id', function ($query) {
        $query->select('post_id')
              ->from('saves')
              ->where('user_id', auth()->id());
    })
    ->latest()
    ->get();


    return view('community.community', compact('publicPosts', 'myPosts', 'savedPosts'));
}
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        Post::create([
        'user_id' => auth()->id(),
            'content' => $request->content
        ]);

        return redirect()->route('community');
    }

    public function myFeed()
    {
        $posts = Post::with('user')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('community.my', compact('posts'));
    }

        public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // hanya owner atau admin boleh delete
        if ($post->user_id == auth()->id() || auth()->user()->role == 'admin') {
            $post->delete();
        }

        return back();
    }
public function like($postId)
{
    $like = Like::where('post_id', $postId)
        ->where('user_id', auth()->id())
        ->first();

    if ($like) {
        $like->delete();
        $liked = false;
    } else {
        Like::create([
            'post_id' => $postId,
            'user_id' => auth()->id()
        ]);
        $liked = true;
    }

    $count = Like::where('post_id', $postId)->count();

    return response()->json([
        'liked' => $liked,
        'count' => $count
    ]);
}
    public function comment(Request $request, $postId)
{
    $request->validate([
        'comment' => 'required|string|max:500'
    ]);

    Comment::create([
        'post_id' => $postId,
        'user_id' => auth()->id(),
        'comment' => $request->comment
    ]);

    return back();
}

public function save($postId)
{
    $save = Save::where('post_id', $postId)
        ->where('user_id', auth()->id())
        ->first();

    if ($save) {
        $save->delete();
        $saved = false;
    } else {
        Save::create([
            'post_id' => $postId,
            'user_id' => auth()->id()
        ]);
        $saved = true;
    }

    $count = Save::where('post_id', $postId)->count();

    return response()->json([
        'saved' => $saved,
        'count' => $count
    ]);
}
}