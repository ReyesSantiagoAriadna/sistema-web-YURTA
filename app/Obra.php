<?php


namespace App;
use Illuminate\Database\Eloquent\Model;

class Obra extends Model{
    protected $table='obra';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = ['id','descripcion','lat','lng','fech_ini','fech_fin','dependencia','encargado','tipo_obra'];
}