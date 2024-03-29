<?php

use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

function isOwner($id)
{
    return $id == Auth::id();
}

function setUserActivity()
{
    $user = User::find(Auth::id());
    $user->last_active = Carbon::now();
    $user->save();
}

function getFileName()
{

}

function getUserAvatar($user)
{
    return $user->avatar ? "/user/$user->id/avatar/$user->avatar" : 'https://picsum.photos/32/32/?random';
}

function getUserBanner($user)
{
    return $user->banner
        ? "/user/$user->id/banner/$user->banner"
        : 'https://images.unsplash.com/photo-1605379399642-870262d3d051?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80';
}

function resizeFile()
{

}

function uploadPath()
{

}

function uploadFile()
{

}

function getMonthlyMetrics($collection, $currentMonth)
{
    $metrics = new Collection;
    foreach ($collection as $c) {
        if ($c->created_at->format('M') == $currentMonth) {
            $metrics[] = $c;
        }
    }

    return $metrics;
}

function getGroupAvatar($group)
{
    return $group->avatar ? "/group/$group->id/avatar/$group->avatar" : 'https://picsum.photos/32/32/?random';
}

function getGroupBanner($group)
{
    return $group->banner
        ? "/group/$group->id/banner/$group->banner"
        : 'https://images.unsplash.com/photo-1605379399642-870262d3d051?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80';
}
