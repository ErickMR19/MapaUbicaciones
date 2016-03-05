<?php

namespace MapaUbicaciones;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    public $table = "provincias";

    protected $guarded = array('id');
    protected $fillable = array('nombre');

    public function cantones()
    {
    	return $this->hasMany(Canton::class);
    }

    public static $rules = array
    (
    	'nombre' => 'required|min:5|unique:provincias'
    );
}
