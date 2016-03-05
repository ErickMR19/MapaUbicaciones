@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
					<h3 align="center">Agregar Categoría</h3>
					{{ Form::open(array('route' => 'storecategoria')) }}	
					<div class="form-group">
					{{ Form::label('descripcion', 'Descripción:') }}
		            {{ Form::text('descripcion',null,array('class'=> 'form-control')) }}			
		            </div>
		            <div align="center">	    
					{{ Form::submit('Agregar', array('class' => 'btn btn-info')) }}
					</div>
					{{ Form::close() }}

					@if ($errors->any())
					 <span class="help-inline" style="color:red">*{{ implode('', $errors->all(':message')) }}</span>
					@endif
  				</div>
            </div>
        </div>
    </div>
</div>
@stop