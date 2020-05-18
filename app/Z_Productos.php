<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Z_Productos extends Model
{
    protected $table='z_productos';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable = ['id','idCultivo','nombre','equiKilos','precioMay','precioMen',
        'cantExis','semana'];


}
