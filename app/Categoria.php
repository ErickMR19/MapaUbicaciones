<?php

namespace MapaUbicaciones;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public $table = "categories";

    protected $guarded = array('id');
    protected $fillable = array('descripcion');

    public static $rules = array
    (
    	'descripcion' => 'required|min:3|unique:categories'
    );

}
