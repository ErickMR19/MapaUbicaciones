@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 align="center">Editar Usuario</h3>
                    {{ Form::model($usuario, array('method' => 'PUT', 'route' => array('updatepassusuario',$usuario->id))) }}
                    <div class="form-group">
                    {{ Form::label('email', 'Correo:') }}
                    {{ Form::text('email',null,array('class'=> 'form-control', 'readonly' => 'true')) }}               
                    </div> 
                    <div class="form-group">
                    {{ Form::label('password', 'Contraseña:') }}
                    {{ Form::password('password',null,array('class'=> 'form-control')) }}
                    </div> 
                    <div class="form-group">
                    {{ Form::label('password_confirm', 'Repetir Contraseña:') }}
                    {{ Form::password('password_confirm',null,array('class'=> 'form-control')) }}
                    </div> 
                    <div align="center">
                        {{ Form::submit('Actualizar', array('class' => 'btn btn-info')) }}    
                        {{ link_to_route('indexusuario', 'Cancelar', $usuario->id=0, array('class' => 'btn btn-danger')) }} 
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