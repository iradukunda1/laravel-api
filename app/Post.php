<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    //
    protected $fillable = [
        'title',
        'content'
    ];
    public function user(){
        return  $this->belongsTo('App\User');
    }

    public function photos(){
        return $this->morphMany('App\Photo','imageable');
    }

    public function tags(){
        return $this->morphTOMany('App\tag','taggable');
    }

    public static function scopeLatest($query){
        return $query->orderBy('id','asc')->get();
    }
}
