<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Image extends Model
{
    //indicar la tabla que va a modificar este modelo
    protected $table = 'images';

    //Relacion one to many
    public function comments(){
        return $this->hasMany('App\Comment')->orderBy('id', 'desc');
    }

    //relacion one to many
    public function likes(){
        return $this->hasMany('App\Like');
    }

    //relacion many to one
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
    
    
}
