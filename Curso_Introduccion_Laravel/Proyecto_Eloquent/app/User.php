<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany(Post::class); //Un usuario tiene muchos posts
    }

    //Sobre escritura de metodo
    public function getGetNameAttribute()
    {
        return strtoupper($this->name); //Regresar todo el campo en mayusculas
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value); //Al momento de que se guarde, se guardara en minuscula en la bd
    }

    //ucfirst() //La primera letra mayuscula y las demas minuscula
}
