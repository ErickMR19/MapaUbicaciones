@extends('layouts.app')

@section('content')
	<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
					<h3>Lista de Usuarios</h3>
					 	<p>{{link_to_route('createusuario', 'Registrar Usuario')}}</p>

						@if($usuarios->count())
							<table class="table table-hover table-bordered">
								<thead class="thead-inverse">
									<tr>
										<th>Nombre</th>
										<th>Usuario</th>
										<th colspan="3">Acciones</th>
									</tr>
								</thead>
								<tbody>
										@foreach ($usuarios as $usuario)
										<tr>
											<td width="40%">{{$usuario->name}}</td>
											<td width="300%">{{$usuario->email}}</td>
											<td width="10%">
												{{link_to_route('editusuario','Editar',array($usuario->id),array('class'=>'btn btn-info'))}}
											</td>
											<td width="10%">
												{{link_to_route('passusuario','Cambiar Contraseña',array($usuario->id),array('class'=>'btn btn-info'))}}
											</td>
											<td width="10%">
												{{ Form::open(array('method' => 'DELETE', 'route' => array('deleteusuario', $usuario->id))) }}                       
						                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
						                        {{ Form::close() }}
						                    </td>
					                </tr>
										@endforeach			
								</tbody>
							</table>
						@else
							No hay usuarios
						@endif
						
                </div>
            </div>
        </div>
    </div>
</div>

@stop