@extends('layouts.app')

@section('content')
	<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
					<h3>Lista de Distritos</h3>
						<p>{{link_to_route('createdistrito', 'Registrar Distrito')}}</p>

						@if($distritos->count())
							<table class="table table-hover table-bordered">
								<thead class="thead-inverse">
									<tr>
										<th>Distrito</th>
										<th>Cantón</th>
										<th>Provincia</th>
										<th colspan="2">Acciones</th>
									</tr>
								</thead>
								<tbody>
										@foreach ($distritos as $distrito)
										<tr>
											<td width="34%">{{$distrito->nombre}}</td>
											<td width="23%">{{$distrito->canton->nombre}}</td>
											<td width="23%">{{$distrito->canton->provincia->nombre}}</td>
											<td width="10%">
												{{link_to_route('editdistrito','Editar',array($distrito->id),array('class'=>'btn btn-info'))}}
											</td>
											<td width="10%">
												{{ Form::open(array('method' => 'DELETE', 'route' => array('deletedistrito', $distrito->id))) }}                       
						                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
						                        {{ Form::close() }}
						                    </td>
					                </tr>
										@endforeach			
								</tbody>
							</table>
						@else
							No hay distritos
						@endif
						
                </div>
            </div>
        </div>
    </div>
</div>

@stop