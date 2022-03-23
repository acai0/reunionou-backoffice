<?php

namespace reu\back1\app\models;

class User extends \Illuminate\Database\Eloquent\Model
{

    protected static $table = 'user';
    protected static $primaryKey = 'id';
    public    $timestamps = false;
}
