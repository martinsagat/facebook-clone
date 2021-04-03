<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\LikeCollection;

class PostLikeController extends Controller
{
    public function store(Post $post)
    {
        
        $post->likes()->toggle(auth()->user());

        return new LikeCollection($post->likes);
    }
}
