@extends('layouts.app')

@section('content')
	<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
					<h3>Lista de Cantones</h3>
						<p>{{link_to_route('createcanton', 'Registrar Cantón')}}</p>

						@if($cantones->count())
							<table class="table table-hover table-bordered">
								<thead class="thead-inverse">
									<tr>
										<th>Cantón</th>
										<th>Provincia</th>
										<th colspan="2">Acciones</th>
									</tr>
								</thead>
								<tbody>
										@foreach ($cantones as $canton)
										<tr>
											<td width="40%">{{$canton->nombre}}</td>
											<td width="40%">{{$canton->provincia->nombre}}</td>
											<td width="10%">
												{{link_to_route('editcanton','Editar',array($canton->id),array('class'=>'btn btn-info'))}}
											</td>
											<td width="10%">
												{{ Form::open(array('method' => 'DELETE', 'route' => array('deletecanton', $canton->id))) }}                       
						                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
						                        {{ Form::close() }}
						                    </td>
					                </tr>
										@endforeach			
								</tbody>
							</table>
						@else
							No hay cantones
						@endif
						
                </div>
            </div>
        </div>
    </div>
</div>

@stop