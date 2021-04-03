<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Friend;
use App\Http\Resources\PostCollection;

class PostController extends Controller
{

    public function index()
    {
        $friends = Friend::friendships();
        
        if ($friends->isEmpty()) {
            return new PostCollection(Request()->user()->posts);
        }
        
        return new PostCollection(
            Post::whereIn('user_id', [$friends->pluck('user_id'), $friends->pluck('friend_id')])
            ->get()
        );

    }
    
    public function store()
    {
        $data = request()->validate([
            'data.attributes.body' => '',
        ]);

        $post = request()->user()->posts()->create($data['data']['attributes']);
        
        return new PostResource($post);
    }
}
