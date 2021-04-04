<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Permission;

class role extends Model
{

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
