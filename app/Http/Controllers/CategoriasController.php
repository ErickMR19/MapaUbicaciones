<?php

namespace MapaUbicaciones\Http\Controllers;

use MapaUbicaciones\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use MapaUbicaciones\Http\Controllers\Controller;
use View;

class CategoriasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function indexCategoria()
   	{
   		$categorias =  Categoria::all();

   		return view('categorias.index',compact('categorias'));   	
   	}

   	public function createCategoria()
    {
         return View::make('categorias.create');
    }

	public function saveCategoria()
    {
         $input = Input::all();
         $validation = Validator::make($input, Categoria::$rules);

           if ($validation->passes())
           {
               Categoria::create($input);

               return Redirect::route('indexcategoria');
           }

      return Redirect::route('createcategoria')
                        ->withInput()
                        ->withErrors($validation)
                        ->with('message', 'Hay errores de validación.');
    }

    public function showCategoria($id)
   	{
         $categoria = Categoria::find($id);
           
   		return View::make('categorias.show')->with('categoria', $categoria);   	
      }

	  public function editCategoria($id)
   	{
   		$categoria = Categoria::find($id);

           if (is_null($categoria))
           {
               return Redirect::route('indexcategoria');
           }
           return View::make('categorias.edit', compact('categoria'));
   	}

   	public function updateCategoria($id)
   	{
         $input = Input::all();
         $validation = Validator::make($input, Categoria::$rules);
           
           if ($validation->passes())
           {
               $categoria = Categoria::find($id);
               $categoria->update($input);
               return Redirect::route('indexcategoria');
           }
           return Redirect::route('editcategoria', $id)
                              ->withInput()
                              ->withErrors($validation)
                              ->with('message', 'Hay errores de validación.');	
   	}

   	public function deleteCategoria($id)
   	{
      try
      {
        Categoria::find($id)->delete();
      }
      catch(\Illuminate\Database\QueryException $e)
      {
        return Redirect::route('indexcategoria');

      }
      return Redirect::route('indexcategoria');
   	}
    
}
