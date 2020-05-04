<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table='producto';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable = ['id','solar','cultivo','nombre','cont_caja','precio_mayoreo',
        'precio_menudeo','url_imagen'];


}

