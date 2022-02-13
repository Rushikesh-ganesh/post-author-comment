<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    use HasFactory;
    public $timestamps = TRUE;

    protected $table = 'post';

    protected $fillable = ['author_id','post_title','post_description'];

    public function Author(){
        return $this->hasOne('App\Models\User', 'id','author_id');
    }

    public function comments(){
        return $this->hasMany('App\Models\PostCommentModel', 'post_id','id');
    }

}
