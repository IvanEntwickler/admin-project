<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $guarded = [];
    public function permissions() {
        return $this->belongsToMany('App\Permission');
    }
    public function users() {
        return $this->belongsToMany('App\User');
    }
}
