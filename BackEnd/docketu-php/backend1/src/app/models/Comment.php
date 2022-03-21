<?php
    namespace reu\back\app\models;

    class Comment extends \Illuminate\Database\Eloquent\Model {

        protected $table      = 'comment'; 
        protected $primaryKey = 'id';     
        public    $timestamps = false;    

    }
    /*public $table='commande';
    public $primaryKey='id';
    public $incrementing = false;
    public $keyType='String';
    public $timestamps = true;
    */
    ?>