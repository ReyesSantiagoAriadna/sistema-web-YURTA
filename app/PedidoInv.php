<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoInv extends Model
{
    protected $table='pedidoInv';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable = ['id','fecha_pedido','fecha_entrega','estado','cliente'];
}
