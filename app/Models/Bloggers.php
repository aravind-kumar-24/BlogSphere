<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;

class Bloggers extends User
{
    protected $table = 'bloggers';

    protected $guarded = [];

    public function states(){
        return $this->belongsTo(States::class, 'state_id');
    }

    public function cities(){
        return $this->belongsTo(Cities::class, 'city_id');
    }

    public function blogs(){
        return $this->hasMany(Blogs::class);
    }
}
