<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class States extends Model
{
    use SoftDeletes;

    protected $table = 'states';
    
    protected $guarded = [];

    public function cities(){
        return $this->hasMany(Cities::class);
    }

    public function bloggers(){
        return $this->hasMany(Bloggers::class);
    }
}
