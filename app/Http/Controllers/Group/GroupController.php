<?php

namespace App\Http\Controllers\Group;

use App\Http\Controllers\Controller;
use App\Models\Group\Group;
use App\Models\Group\GroupUser;
use App\Models\Post\Category;
use App\Models\Post\Post;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        // select all group user records so we can see what groups you are in
        $groupUser = GroupUser::select('group_id')->where('user_id', Auth::id())->get();

        // get the full collection of the groups you are in
        $groups = Group::whereIn('id', $groupUser)->get();

        // for each group you are in get the id of the group
        $userGroups = [];
        foreach ($groups as $group) {
            $userGroups[] = $group->id;
        }

        // get all posts from groups that you are a member of
        $posts = Post::latest()
            ->whereNotNull('group_id')
            ->whereIn('group_id', $userGroups)
            ->paginate(8);

        $categories = Category::all();

        return view('group.index', compact('groups', 'posts', 'categories'));
    }
}
