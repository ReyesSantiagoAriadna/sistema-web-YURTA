<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table='material';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable = ['id','descripcion','unidad','tipo','marca','existencias',
        'cantidad_minima','precio_unitario'
        ,'proveedor','url_imagen'];


}
