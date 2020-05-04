<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    protected $table='promocion';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable = ['id','descripcion','url_imagen'];


}
