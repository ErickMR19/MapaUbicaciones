<?php

namespace MapaUbicaciones;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
	public $table = "users";

	protected $guarded = array('id');
    protected $fillable = ['email','name','password','password_confirm'];
 
    public static $rules = array
    (
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users',
        'password'=>'required',
        'password_confirm'=>'required|same:password'
    );

    public static $update = array
    (
        'name' => 'required|min:3',
        'email' => 'required|email|exists:users,email'
    );

    public static $pass = array
    (
        'email' => 'required|email|exists:users,email',
        'password'=>'required',
        'password_confirm'=>'required|same:password'
    );
}
