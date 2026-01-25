<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    protected $table = 'blogs';

    protected $guarded = [];

    public function bloggers(){
        return $this->belongsTo(Bloggers::class);
    }

    public function categories(){
        return $this->belongsTo(BlogCategories::class, 'blog_category_id', 'id');
    }
}
