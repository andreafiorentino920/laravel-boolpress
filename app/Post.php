<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ["title", "slug", "content", "category_id"];
    
    public function category()
    {
        return $this->belongsTo("App\Category");
    }
    public function tags()
    {
        return $this->belongsTo("App\Tag");
    }
}
