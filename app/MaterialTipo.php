<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class MaterialTipo extends Model
{
    protected $table='tipo_material';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable = ['id','descripcion'];
}