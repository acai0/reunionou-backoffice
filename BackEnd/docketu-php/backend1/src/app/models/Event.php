<?php
    namespace reu\back\app\models;
    
    class Event extends \Illuminate\Database\Eloquent\Model {

        protected $table      = 'event'; 
        protected $primaryKey = 'id';     
        public    $timestamps = false;    

    }