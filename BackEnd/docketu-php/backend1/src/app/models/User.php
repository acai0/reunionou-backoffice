<?php
    namespace reu\back\app\models;

    class User extends \Illuminate\Database\Eloquent\Model {

        protected $table      = 'user'; 
        protected $primaryKey = 'id';     
        public    $timestamps = false;    

        public function event (){
            return $this->hasMany('reu\back\models\Event', 'id_user');
        }

        public function comment (){
            return $this->hasMany('reu\back\models\Comment', 'id_user');
        }

    }