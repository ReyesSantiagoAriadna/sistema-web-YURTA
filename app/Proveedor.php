<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table='proveedor';

    protected $primarykey = 'id';

    public $timestamps = false;

    public function materiales(){
        return $this->hasMany(Material::class);
    }


    protected $fillable = ['id','razon_social','email','telefono','direccion'];

  
}
