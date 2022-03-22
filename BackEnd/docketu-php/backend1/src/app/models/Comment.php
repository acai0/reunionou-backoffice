<?php
    namespace reu\back\app\models;

    class Comment extends \Illuminate\Database\Eloquent\Model {

        protected $table      = 'comment'; 
        protected $primaryKey = 'id';     
        public    $timestamps = false;   

        public function user(){
            return $this->belongsTo('reu\back\models\User', 'id_user');
        } 

        public function event(){
            return $this->belongsTo('reu\back\models\Event', 'id_event');
        } 

    }
    /*public $table='commande';
    public $primaryKey='id';
    public $incrementing = false;
    public $keyType='String';
    public $timestamps = true;
    */
    ?>