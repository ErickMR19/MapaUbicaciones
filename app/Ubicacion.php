<?php

namespace MapaUbicaciones;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    public $table = "locations";

    protected $guarded = array('id');
	protected $fillable = ['nombre','telefono','web','latitude','longitude','distrito_id','categories_id'];

    public static $rules = array
    (
        'nombre' => 'required|min:3',
        'latitude' => 'required',
        'longitude'=>'required',
        'distrito_id'=>'required|exists:distritos,id',
        'categories_id'=>'required|exists:categories,id'
    );

    public function categoria()
    {
    	return $this->belongsTo(Categoria::class,'categories_id');
    }

    public function distrito()
    {
        return $this->belongsTo(Distrito::class);
    }

}
