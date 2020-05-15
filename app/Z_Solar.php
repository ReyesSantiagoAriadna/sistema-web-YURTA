<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Z_Solar extends Model
{
    protected $table='z_solar';

    protected $primarykey = 'id'; 

    public $timestamps = false;

    protected $fillable = ['id','nombre','largo','ancho','region','distrito','municipio',
        'latitud','longitud','descripcion','costoHora'];


}
