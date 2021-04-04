<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\user\tag;
use App\Models\user\category;

class post extends Model
{
public function tags()
{
    return $this->belongsToMany(tag::class,'post_tags')->withTimestamps();                                                          // withTimestamps ka use isly kiya kyoki posts_tag table me created_at and updated_at aa jaye
}

public function categories()
{
    return $this->belongsToMany(category::class,'category_posts')->withTimestamps();
}


public function getRouteKeyName()
{
    return 'slug';
}

}
