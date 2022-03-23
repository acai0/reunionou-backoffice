<?php

namespace reu\back1\app\models;

class Event extends \Illuminate\Database\Eloquent\Model
{
    public $table = 'event';
    public $primaryKey = 'id';
    public $timestamps = false;

    public function user(){
        return $this->belongsTo('reu\back\models\User', 'id_user');
    }

    public function comment(){
        return $this->hasMany('reu\back\models\Comment', 'id_event');
    }
}
