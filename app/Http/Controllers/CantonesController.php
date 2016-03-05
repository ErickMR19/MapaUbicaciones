<?php

namespace MapaUbicaciones\Http\Controllers;

use MapaUbicaciones\Canton;
use MapaUbicaciones\Provincia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use MapaUbicaciones\Http\Controllers\Controller;
use View;
use Push;
use DB;

class CantonesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexCanton()
   	{
   		$cantones =  Canton::all();
   		return view('cantones.index',compact('cantones'));   	
   	}

      public function createCanton()
      {
         $provincia = Provincia::lists('nombre','id'); 
        
         return View::make('cantones.create',compact('provincia'));
      }

      public function saveCanton()
      {         
         $input = Input::all();
         $validation = Validator::make($input, Canton::$rules);

           if ($validation->passes())
           {
               Canton::create($input);

               return Redirect::route('indexcanton');
           }

      return Redirect::route('createcanton')
                        ->withInput()
                        ->withErrors($validation)
                        ->with('message', 'Hay errores de validación.');
      }
      
      public function showCanton($id)
      {
         $canton = Canton::find($id);
           
         return View::make('cantones.show')->with('canton', $canton);    
      }

     public function editCanton($id)
      {
         $canton = Canton::find($id);
         $provincia = Provincia::lists('nombre','id');

           if (is_null($canton))
           {
               return Redirect::route('indexcanton');
           }
           return View::make('cantones.edit', compact('canton','provincia'));
      }

      public function updateCanton($id)
      { 
         try
         {
          $input = Input::all();
          $validation = Validator::make($input, Canton::$rules);
           
           if ($validation->passes())
           {
               $canton = Canton::find($id);
               $canton->update($input);
               return Redirect::route('indexcanton');
           }
           return Redirect::route('editcanton', $id)
                              ->withInput()
                              ->withErrors($validation)
                              ->with('message', 'Hay errores de validación.');   
         }
         catch(\Illuminate\Database\QueryException $e)
          {
            return Redirect::route('indexcanton');
          }
         
      }

      public function deleteCanton($id)
      {
        try
        {
          Canton::find($id)->delete();
        }
        catch(\Illuminate\Database\QueryException $e)
        {
          return Redirect::route('indexcanton');

        }
        return Redirect::route('indexcanton');
      }      

}
