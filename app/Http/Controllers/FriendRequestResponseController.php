<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;
use App\Http\Resources\FriendResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\FriendRequestNotFoundException;

class FriendRequestResponseController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'user_id' => '',
            'status' => '',
        ]);
        
        try {
        $friendRequest = Friend::where('user_id', $data['user_id'])
            ->where('friend_id', auth()->user()->id)
            ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new FriendRequestNotFoundException();
        }


        $friendRequest->update(array_merge($data, [
            'confirmed_at' => now(),
        ]));

        return new FriendResource($friendRequest);

    }

}
