<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class DetallePedidoInv extends Model{
    protected $table='det_pedido_inv';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = ['id','medida','cantidad','id_pedido','ped_producto'];
}
