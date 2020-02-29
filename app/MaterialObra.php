<?php


namespace App;
use Illuminate\Database\Eloquent\Model;

class MaterialObra extends Model{
    protected $table='materiales_obra';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = ['id','cantidad','cantidad_minima','id_obra','mat_obra'];


    public function material()
    {
        return $this->hasMany('Material');
    }
}