<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCommentModel extends Model
{
    use HasFactory;
    public $timestamps = TRUE;

    protected $table = 'post_comment';

    protected $fillable = ['post_id','post_comment','user_id'];
    
    public function commented_by(){
        return $this->hasOne('App\Models\User', 'id','user_id');
    }
}
