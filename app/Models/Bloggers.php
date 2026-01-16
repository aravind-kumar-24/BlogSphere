<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;

class Bloggers extends User
{
    protected $table = 'bloggers';

    protected $guarded = [];

    public function states(){
        return $this->belongsTo(States::class);
    }

    public function cities(){
        return $this->belongsTo(Cities::class);
    }
}
