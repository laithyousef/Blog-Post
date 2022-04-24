<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function category() {
       return  $this->belongsTo('App\Models\Category');
    }

    public function tags() {
        return  $this->belongsToMany('App\Models\Tag' ,  'post_tag_custom' , 'tag_id' , 'post_id');
     }

     public function comments() {
      return  $this->hasMany('App\Models\Comment');
   }
}
