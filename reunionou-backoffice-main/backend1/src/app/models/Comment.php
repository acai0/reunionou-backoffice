<?php

namespace reu\back1\app\models;

class Comment extends \Illuminate\Database\Eloquent\Model
{

    protected $table      = 'comment';
    protected $primaryKey = 'id';
    public    $timestamps = false;

    public function event(){
        return $this->belongsTo('reu\back\models\Event', 'id_event');
    } 

}
