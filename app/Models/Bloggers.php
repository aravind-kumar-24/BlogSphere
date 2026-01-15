<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bloggers extends Model
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
