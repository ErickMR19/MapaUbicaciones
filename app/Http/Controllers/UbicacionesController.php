<?php

namespace MapaUbicaciones\Http\Controllers;

use MapaUbicaciones\Ubicacion;
use MapaUbicaciones\Distrito;
use MapaUbicaciones\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use MapaUbicaciones\Http\Controllers\Controller;
use View;
use DB;

class UbicacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>'allToJson']);
    }

    public function indexUbicacion()
   	{
   		$ubicaciones =  Ubicacion::all();

   		return view('ubicaciones.index',compact('ubicaciones'));   	
   	}

   	public function createUbicacion()
    {
         $distrito = DB::table('distritos')
                    ->join('cantones','distritos.canton_id','=','cantones.id')
                    ->join('provincias','cantones.provincia_id','=','provincias.id')
                    ->select(DB::raw('CONCAT("Provincia: ",provincias.nombre," - Cantón: ",cantones.nombre," - Distrito: ",distritos.nombre) as nombre,distritos.id'))->lists('nombre','id');
         $categoria = Categoria::lists('descripcion','id'); 

         return View::make('ubicaciones.create',compact('distrito','categoria'));
    }

    public function saveUbicacion()
    {
         $input = Input::all();

         $validation = Validator::make($input, Ubicacion::$rules);

           if ($validation->passes())
           {
              $geometrias="GeomFromText('POINT(".Input::get('longitude')." ".Input::get('latitude').")')";

              $geometria=DB::raw($geometrias);

              
              DB::table('locations')->insert(
                ['nombre'=>Input::get('nombre'),
                 'categories_id'=>Input::get('categories_id'),
                 'distrito_id'=>Input::get('distrito_id'),
                 'latitude'=>Input::get('latitude'),
                 'longitude'=>Input::get('longitude'),
                 'telefono'=>Input::get('telefono'),
                 'web'=>Input::get('web'),
                 'geometria'=>$geometria
                 ]
                );
            return Redirect::route('indexubicacion');
            }

      return Redirect::route('createubicacion')
                        ->withInput()
                        ->withErrors($validation)
                        ->with('message', 'Hay errores de validación.');
    }

    public function showUbicacion($id)
   	{
         $ubicacion = Ubicacion::find($id);
           
   		return View::make('ubicaciones.show')->with('ubicacion', $ubicacion);   	
    }

	public function editUbicacion($id)
   	{
   		$ubicacion = Ubicacion::find($id);
      $distrito = DB::table('distritos')
                    ->join('cantones','distritos.canton_id','=','cantones.id')
                    ->join('provincias','cantones.provincia_id','=','provincias.id')
                    ->select(DB::raw('CONCAT("Provincia: ",provincias.nombre," - Cantón: ",cantones.nombre," - Distrito: ",distritos.nombre) as nombre,distritos.id'))->lists('nombre','id');
      $categoria = Categoria::lists('descripcion','id'); 
           if (is_null($ubicacion))
           {
               return Redirect::route('indexubicacion');
           }
           return View::make('ubicaciones.edit', compact('ubicacion','distrito','categoria'));
   	}

   	public function updateUbicacion($id)
   	{
         $input = Input::all();
         

         $validation = Validator::make($input, Ubicacion::$rules);

           if ($validation->passes())
           {
              $geometrias="GeomFromText('POINT(".Input::get('longitude')." ".Input::get('latitude').")')";

              $geometria=DB::raw($geometrias);

              DB::table('locations')
              ->where('id',$id)
              ->update(
                ['nombre'=>Input::get('nombre'),
                 'categories_id'=>Input::get('categories_id'),
                 'distrito_id'=>Input::get('distrito_id'),
                 'latitude'=>Input::get('latitude'),
                 'longitude'=>Input::get('longitude'),
                 'telefono'=>Input::get('telefono'),
                 'web'=>Input::get('web'),
                 'geometria'=>$geometria
                 ]
                );
            return Redirect::route('indexubicacion');
          }
        //return $input;
      return Redirect::route('createubicacion')
                          ->withInput()
                          ->withErrors($validation)
                          ->with('message', 'Hay errores de validación.');
   	}

   	public function deleteUbicacion($id)
   	{
      try
      {
        Ubicacion::find($id)->delete();
      }
      catch(\Illuminate\Database\QueryException $e)
      {
         return Redirect::route('indexubicacion');
      }
      return Redirect::route('indexubicacion');
   	}
    
    public function allToJson(){
   		$ubicaciones = Ubicacion::select('id', 'latitude as X', 'longitude as Y' ,'nombre', 'telefono', 'distrito_id as distrito', 'categories_id as categoria')->get();
        //return print_r($ubicaciones);
       //exit;
        return response()->json($ubicaciones)->header('Access-Control-Allow-Origin', 'http://127.0.0.1');
    }
}
