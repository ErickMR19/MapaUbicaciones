@extends('layouts.app')

@section('content')
	<div class="container-fluid">
    <div class="row">
        <div class="col-md-22">
            <div class="panel panel-default">
                <div class="panel-body">
					<h3>Lista de Ubicaciones</h3>
						<p>{{link_to_route('createubicacion', 'Registrar Ubicacion')}}</p>

							@if($ubicaciones->count())
							<div class="table-responsive">
							<div class="bodycontainer scrollable">
							<table class="table table-hover table-bordered table-scrollable">
								<thead class="thead-inverse">
									<tr>
										<th>Ubicación</th>
										<th>Teléfono</th>
										<th>Web</th>
										<th>Categoría</th>
										<th>Localización</th>
										<th>Distrito</th>
										<th colspan="2">Acciones</th>
									</tr>
								</thead>
								<tbody>
										@foreach ($ubicaciones as $ubicacion)
										<tr>
											<td>{{$ubicacion->nombre}}</td>
											<td>{{$ubicacion->telefono}}</td>
											<td>{{$ubicacion->web}}</td>
											<td>{{$ubicacion->categoria->descripcion}}</td>
											<td>{{$ubicacion->latitude}},{{$ubicacion->longitude}}</td>
											<td>{{$ubicacion->distrito->nombre}}</td>
											<td>
												{{link_to_route('editubicacion','Editar',array($ubicacion->id),array('class'=>'btn btn-info'))}}
											</td>
											<td>
												{{ Form::open(array('method' => 'DELETE', 'route' => array('deleteubicacion', $ubicacion->id))) }}                       
						                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
						                        {{ Form::close() }}
						                    </td>
					                </tr>
										@endforeach			
								</tbody>
							</table>
							</div>
							</div>
						@else
							No hay Ubicaciones
						@endif
						
                </div>
            </div>
        </div>
    </div>
</div>
@stop