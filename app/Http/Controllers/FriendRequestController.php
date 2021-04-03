<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;
use App\Models\User;
use App\Http\Resources\FriendResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Exceptions\UserNotFoundException;


class FriendRequestController extends Controller
{
    public function store() 
    {
    
        $data = request()->validate([
            'friend_id' => 'required',
        ]);
        

        try {
            User::findOrFail($data['friend_id'])
            ->friends()->syncWithoutDetaching(auth()->user());
        
        } catch (ModelNotFoundException $e) {
            throw new UserNotFoundException();
        }
        
        return new FriendResource(
            Friend::where('user_id', auth()->user()->id)
                ->where('friend_id', $data['friend_id'])
                ->first()
        );

    }
}
