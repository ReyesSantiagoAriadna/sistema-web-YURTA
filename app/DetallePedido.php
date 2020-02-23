<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model{
    protected $table='det_ped';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = ['id','cantidad','id_pedido','ped_material'];
}
