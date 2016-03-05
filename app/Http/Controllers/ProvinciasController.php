<?php

namespace MapaUbicaciones\Http\Controllers;

use MapaUbicaciones\Provincia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use MapaUbicaciones\Http\Controllers\Controller;
use View;

class ProvinciasController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

   	public function indexProvincia()
   	{
   		$provincias = Provincia::all();

   		return view('provincias.index',compact('provincias'));
   	}

   	public function createProvincia()
   	{
   		return View::make('provincias.create');
   	}

   	public function saveProvincia()
   	{
         $input = Input::all();
         $validation = Validator::make($input, Provincia::$rules);

           if ($validation->passes())
           {
               Provincia::create($input);

               return Redirect::route('indexprovincia');
           }

      return Redirect::route('createprovincia')
                        ->withInput()
                        ->withErrors($validation)
                        ->with('message', 'Hay errores de validación.');
   	}

   	public function showProvincia($id)
   	{
         $provincia = Provincia::find($id);
           
   		return View::make('provincias.show')->with('provincia', $provincia);   	
      }

	  public function editProvincia($id)
   	{
   		$provincia = Provincia::find($id);

           if (is_null($provincia))
           {
               return Redirect::route('indexprovincia');
           }
           return View::make('provincias.edit', compact('provincia'));
   	}

   	public function updateProvincia($id)
   	{
         $input = Input::all();
         $validation = Validator::make($input, Provincia::$rules);
           
           if ($validation->passes())
           {
               $provincia = Provincia::find($id);
               $provincia->update($input);
               return Redirect::route('indexprovincia');
           }
           return Redirect::route('editprovincia', $id)
                              ->withInput()
                              ->withErrors($validation)
                              ->with('message', 'Hay errores de validación.');	
   	}

   	public function deleteProvincia($id)
   	{
      try
      {
        Provincia::find($id)->delete();
      }
      catch(\Illuminate\Database\QueryException $e)
      {
        return Redirect::route('indexprovincia');
      }
      return Redirect::route('indexprovincia');
   	}
    
    public function allToJson(){
   		$provincias = Provincia::select('id as num', 'nombre')->get();
        return response()->json($provincias);
    }

}
