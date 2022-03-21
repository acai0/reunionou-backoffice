<?php
namespace reu\back\app\models;
class Commande extends \Illuminate\Database\Eloquent\Model{
    public $table='commande';
    public $primaryKey='id';
    public $incrementing = false;
    public $keyType='String';
    public $timestamps = true;
   
    public function items(){
        return $this->hasMany('reu\back\models\Item', 'command_id');
    }
}
?>