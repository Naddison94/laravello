<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\Friend;

class FriendsController extends Controller
{
    public function index($user_id)
    {
        $friends = Friend::where('owner_user_id', $user_id)->paginate(20);
        return view('user.friends.index', compact('friends'));
    }
}
