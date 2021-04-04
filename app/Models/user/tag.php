<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\user\post;

class tag extends Model
{
    public function posts()
    {
        return $this->belongsToMany(post::class, 'post_tags')->orderBy('created_at','DESC')->paginate(5); // it is relationship of tag and post
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }
}
