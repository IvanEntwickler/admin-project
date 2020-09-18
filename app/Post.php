<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Post extends Model
{
    //
    protected $guarded = [];
    public function user() {
        return $this->belongsTo('App\User');
    }
    // /// MUTATOR convention set, columnname, Attribute
    // public function setPostImageAttribute($value) {
    //     $this->attributes['post_image'] = asset($value);
    // }

    /// ACCESSOR convention get, columnname, Attribute
    public function getPostImageAttribute($value)
{
    /// IF $value includes https:// or http:// if it includes the seeded data from lorempixel are returned
    if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
        return $value;
    }
    /// ELSE its returns the uploaded file
    return asset('storage/' . $value);
}

public function category() {
    return $this->belongsTo('App\Category');
}

public function comments() {
    return $this->hasMany('App\Post');
}
}
