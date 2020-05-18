<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Z_Pedido extends Model
{
    protected $table='z_pedido';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable = ['id','id_cliente','fechaSolicitud','fechaSurtido','estatus','total'];


}
