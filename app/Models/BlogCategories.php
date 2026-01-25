<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategories extends Model
{
    protected $table = 'blog_category';

    protected $guarded = [];

    public function blogs(){
        return $this->hasMany(Blogs::class);
    }
}
