<?php

namespace reu\back1\app\models;

class Comment extends \Illuminate\Database\Eloquent\Model
{

    protected $table      = 'comment';
    protected $primaryKey = 'id';
    public    $timestamps = false;
}
