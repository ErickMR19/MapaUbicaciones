<?php

namespace MapaUbicaciones\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use MapaUbicaciones\Http\Requests;
use MapaUbicaciones\Usuario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use MapaUbicaciones\Http\Controllers\Controller;
use View;
use DB;


class UsuariosController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }

    public function indexUsuario()
   	{
   		$usuarios =  Usuario::all();

   		return view('usuarios.index',compact('usuarios'));   	
   	}

   	public function createUsuario()
   	{
   		return View::make('usuarios.create');
   	}

   	public function saveUsuario()
   	{
         $input = Input::all();
         $validation = Validator::make($input, Usuario::$rules);

           if ($validation->passes())
           {
               Usuario::create([
						            'name' => $input['name'],
						            'email' => $input['email'],
						            'password' => bcrypt($input['password']),
        						   ]);

               return Redirect::route('indexusuario');
           }

      return Redirect::route('createusuario')
                        ->withInput()
                        ->withErrors($validation)
                        ->with('message', 'Hay errores de validación.');
   	}

    public function showUsuario($id)
    {
      
      $usuario = Usuario::find($id);
           
      return View::make('usuarios.show')->with('usuario', $usuario);   

      
    }

    public function editUsuario($id)
    {
       $usuario = Usuario::find($id);

       if (is_null($usuario))
       {
           return Redirect::route('indexusuario');
       }

       return View::make('usuarios.edit', compact('usuario'));
       
    }    

    public function passUsuario($id)
    {
       $usuario = Usuario::find($id);

       if (is_null($usuario))
       {
           return Redirect::route('indexusuario');
       }
       return View::make('usuarios.pass', compact('usuario'));
    }    

    public function updateUsuario($id)
    {
        $input = Input::all();
        $validation = Validator::make($input, Usuario::$update);
           
           if ($validation->passes())
           {
              $contrasena=Input::get('password');
              DB::table('users')
              ->where('id',$id)
              ->update(
                ['name'=>Input::get('name'),
                 'email'=>Input::get('email'),
                ]);
               return Redirect::route('indexusuario');
           }
           return Redirect::route('indexusuario', $id)
                              ->withInput()
                              ->withErrors($validation)
                              ->with('message', 'Hay errores de validación.');  
    }

    public function updatepassUsuario($id)
    {
        $input = Input::all();
        $validation = Validator::make($input, Usuario::$pass);
           
           if ($validation->passes())
           {
              $contrasena=Input::get('password');
              DB::table('users')
              ->where('id',$id)
              ->update(
                [
                  'password'=>bcrypt($contrasena),
                ]);
               return Redirect::route('indexusuario');
           }
           return Redirect::route('indexusuario', $id)
                              ->withInput()
                              ->withErrors($validation)
                              ->with('message', 'Hay errores de validación.');  
    }

    public function deleteUsuario($id)
    {
      try
      {
        Usuario::find($id)->delete();
      }
      catch(\Illuminate\Database\QueryException $e)
      {
        return Redirect::route('indexusuario');
      }
      return Redirect::route('indexusuario');

    }


}
