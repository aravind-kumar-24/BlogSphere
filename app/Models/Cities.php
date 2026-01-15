<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cities extends Model
{
    use SoftDeletes;
    
    protected $table = 'cities';

    protected $guarded = [];

    public function states(){
        return $this->belongsTo(States::class);
    }

    public function bloggers(){
        return $this->hasMany(Bloggers::class);
    }
}
