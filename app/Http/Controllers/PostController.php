<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostCollection;

class PostController extends Controller
{

    public function index()
    {
        return new PostCollection(Request()->user()->posts);
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
