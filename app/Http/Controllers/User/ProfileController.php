<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($user_id)
    {
        $user = User::where('id', $user_id)->withCount('posts', 'comments', 'friends')->first();
        return view('user.profile.show', compact('user'));
    }

    public function edit($user_id)
    {
        $user = User::find($user_id);
        return view('user.profile.edit', compact('user'));
    }

    public function update($user_id, Request $request)
    {
        $fileName = null;

        if ($request->file('image')) {
            $fileName = $request->file('image')->getClientOriginalName();
        }

        $user = User::find($user_id);
        $user->avatar = $fileName;

        if ($user->save() && $fileName != false) {
            $request->image->move(public_path("/user/$user->id/avatar/"), $fileName);
        }

        session()->flash('success',  'Profile successfully updated.');

        setUserActivity();

        return view('user.profile.show', compact('user'));
    }
}
