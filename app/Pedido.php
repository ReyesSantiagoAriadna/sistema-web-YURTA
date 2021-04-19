<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table='pedido';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable = ['id','fecha_p','fecha_conf','estado','obra','url_qr'];
}
