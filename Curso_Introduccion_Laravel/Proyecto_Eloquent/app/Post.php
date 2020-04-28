<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{   
    
    protected $table= 'posts';
    protected $fillable = ['user_id', 'title'];
    
    //Un post pertenece a un usuario
    public function user(){
        return $this->belongsTo(User::class);
    }



}
