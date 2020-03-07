<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model{
    protected $table='notifications';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = ['id','type','notifiable_type','notifiable_id'
        ,'data','read_at','created_at','update_at'];
}