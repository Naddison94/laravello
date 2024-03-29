<?php

namespace App\Models\Post;

use App\Models\Group\Group;
use App\Models\User\User;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    public $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'group_id',
        'public',
        'title',
        'body',
        'img',
    ];

    public function scopeFilter($query)
    {
        $like = env('DB_CONNECTION') == 'pgsql' ? 'ilike' : 'like';

        if (request('search')) $query->where('title', $like, '%' . request('search') . '%');
        if (request('category')) $query->whereIn('category_id',  request('category'));
        if (request('search') && (request('category'))) $query->where('title', $like, '%' . request('search') . '%')->whereIn('category_id', request('category'));
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id')->latest();
    }

    public function upvotes()
    {
        return $this->hasMany(Rating::class)->where('upvote', '=', 1);
    }

    public function downvotes()
    {
        return $this->hasMany(Rating::class)->where('downvote', '=', 1);
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
}
