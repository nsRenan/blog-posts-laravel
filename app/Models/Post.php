<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'published_at', 'image_path', 'topic_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
    public function likes()
    {
        return $this->hasMany(PostLike::class);
    }


}
