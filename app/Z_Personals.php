<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Z_Personals extends Model
{
    protected $table='z_personals';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable = ['id','nombre','ap','am','direccion','telefono',
        'celular','rfc', 'costoHora'];


}
