<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class MaterialUnidad extends Model
{
    protected $table='unidad_material';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable = ['id','descripcion'];
}