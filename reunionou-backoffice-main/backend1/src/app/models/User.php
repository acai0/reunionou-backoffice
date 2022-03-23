<?php

namespace reu\back1\app\models;

class User extends \Illuminate\Database\Eloquent\Model
{

    protected static $table = 'user';
    protected static $primaryKey = 'id';
    public    $timestamps = false;

    public function event (){
        return $this->hasMany('reu\back\models\Event', 'id_user');
    }

    public function comment (){
        return $this->hasMany('reu\back\models\Comment', 'id_user');
    }
}
