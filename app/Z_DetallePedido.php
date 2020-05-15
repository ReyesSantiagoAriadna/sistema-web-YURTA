<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Z_DetallePedido extends Model
{
    protected $table='z_pedidodetalle';
 

    public $timestamps = false;

    protected $fillable = ['idPedido','nombreProducto','cantidad','idProducto',
        'unidadM','precioUnitario','subtotal'];


}
