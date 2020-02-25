<?php


namespace App\Http;


use Illuminate\Database\Eloquent\Model;

class TipoObraAtributo extends Model{
    protected $table='tipo_atrib';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = ['id','descripcion','valor'];
}

