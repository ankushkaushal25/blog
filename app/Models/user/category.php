<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\user\post;

class category extends Model
{
    public function posts()
    {
        return $this->belongsToMany(post::class, 'category_posts')->orderBy('created_at','DESC')->paginate(5); // it is relationship object of category and post
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

