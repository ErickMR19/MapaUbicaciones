<?php

namespace MapaUbicaciones;

use Illuminate\Database\Eloquent\Model;

class Canton extends Model
{
	public $table = "cantones";
	
    protected $guarded = array('id');
    protected $fillable = array('nombre','provincia_id');

    public static $rules = array
    (
        'nombre' => 'required|min:3',
        'provincia_id' => 'exists:provincias,id'
    );

    public function provincia()
    {
    	return $this->belongsTo(Provincia::class);
    }

    public function distritos()
    {
    	return $this->hasMany(Distrito::class);
    }
}
