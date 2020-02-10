<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class TipoObra extends Model{
    protected $table='tipo';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable = ['id','descripcion'];
}