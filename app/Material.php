<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table='material';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable = ['id','descripcion','unidad','tipo','marca','existencias','precio_unitario','proveedor'];


}
