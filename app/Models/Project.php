<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    public $guarded = [];

    public function users() {
        return $this->belongsToMany(User::class, 'user_project');
    }

    public function setSlugAttribute($value) {
        $this->attributes['slug'] = Str::slug($value, '_');
    }
}
