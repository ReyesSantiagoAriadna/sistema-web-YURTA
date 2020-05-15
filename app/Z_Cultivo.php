<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Z_Cultivo extends Model
{
    protected $table='z_cultivo';

    protected $primarykey = 'id'; 

    public $timestamps = false;

    protected $fillable = ['id','id_fksolar','tipo','nombre','largo','ancho','fecha',
        'fechaFinal','moniSensor','observacion','tempMin','tempMax','humeMin','humeMax','humeSMin','humeSMax'];
 
}
