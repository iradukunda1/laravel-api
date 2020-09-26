<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

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

    //assign post items to users for one to one relationship
    public function post(){
        //To customize table name and column name
        return $this->hasOne('App\Post','user_id','id');
    }

    //assign post items to users for one to many relationship
    public function posts(){
        return $this->hasMany('App\Post');
    }


    //Many to Many relationship
    public function roles(){
        return $this-> belongsTOMany('App\Role')->withPivot('created_at');
        //To customize table names and column names follow the format below
        // return $this-> belongsTOMany('App\Role','role_user', 'user_id', 'role_id');
    }
    //Morphic Relationship
    public function photos(){
        return $this->morphMany('App\Photo','imageable');
    }

    //getNameAttribute attribute for converting firstLetter to upperCase as data manipulation
    public function getNameAttribute($value){
        return ucfirst($value);
    }
    //setNameAttribute attribute for converting firstLetter to upperCase as data manipulation
    public function  setNameAttribute($value){
        $this->attributes['name'] = ucfirst($value);
    }
}
