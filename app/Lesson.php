<?php

namespace App;

use App\Tag;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded = ['id'];

    public function tags()
    { 
      return $this->belongsToMany(Tag::class);
    }
}
