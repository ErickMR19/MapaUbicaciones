<?php

namespace MapaUbicaciones;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{	
	public $table = "distritos";
	
    protected $guarded = array('id');
	protected $fillable = ['nombre','canton_id'];

    public static $rules = array
    (
        'nombre' => 'required|min:3',
        'canton_id' => 'exists:cantones,id'
    );


    public function canton()
    {
    	return $this->belongsTo(Canton::class);
    }

}
