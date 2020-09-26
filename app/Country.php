<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function posts(){
        //Help to find relate county_id from User and user_id from Post then pull out the post object
        return $this->hasManyThrough('App\Post', 'App\User');
    }
}
