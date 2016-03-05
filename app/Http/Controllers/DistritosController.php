<?php

namespace MapaUbicaciones\Http\Controllers;

use MapaUbicaciones\Distrito;
use MapaUbicaciones\Canton;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use MapaUbicaciones\Http\Controllers\Controller;
use View;
use DB;

class DistritosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexDistrito()
   	{
   		$distritos = Distrito::all();
   		return view('distritos.index',compact('distritos'));
   	}

   	public function createDistrito()
    {
         $canton = DB::table('cantones')
                    ->join('provincias','cantones.provincia_id','=','provincias.id')
                    ->select(DB::raw('CONCAT("Provincia: ",provincias.nombre," - Cantón: ",cantones.nombre) as nombre,cantones.id'))->lists('nombre','id');
         return View::make('distritos.create',compact('canton'));
    }

    public function saveDistrito()
   	{
         $input = Input::all();
         $validation = Validator::make($input, Distrito::$rules);

           if ($validation->passes())
           {
               Distrito::create($input);

               return Redirect::route('indexdistrito');
           }

      return Redirect::route('createdistrito')
                        ->withInput()
                        ->withErrors($validation)
                        ->with('message', 'Hay errores de validación.');
    }

    public function showDistrito($id)
   	{
         $distrito = Distrito::find($id);
           
   		return View::make('distritos.show')->with('distrito', $distrito);   	
    }

	  public function editDistrito($id)
   	{
   		$distrito = Distrito::find($id);

      $canton = DB::table('cantones')
                    ->join('provincias','cantones.provincia_id','=','provincias.id')
                    ->select(DB::raw('CONCAT("Provincia: ",provincias.nombre," - Cantón: ",cantones.nombre) as nombre,cantones.id'))->lists('nombre','id');

           if (is_null($distrito))
           {
               return Redirect::route();
           }
           return View::make('distritos.edit', compact('distrito','canton'));
   	}

   	public function updateDistrito($id)
   	{
         $input = Input::all();
         $validation = Validator::make($input, Distrito::$rules);
           
           if ($validation->passes())
           {
               $distrito = Distrito::find($id);
               $distrito->update($input);
               return Redirect::route('indexdistrito');
           }
           return Redirect::route('editdistrito', $id)
                              ->withInput()
                              ->withErrors($validation)
                              ->with('message', 'Hay errores de validación.');	
   	}

   	public function deleteDistrito($id)
   	{
      try
      {
        Distrito::find($id)->delete();
      }
      catch(\Illuminate\Database\QueryException $e)
      {
        return Redirect::route('indexdistrito');

      }
      return Redirect::route('indexdistrito');
   	}

}
