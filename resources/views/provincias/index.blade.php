@extends('layouts.app')

@section('content')
	<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
					<h3>Lista de Provincias</h3>
						<p>{{link_to_route('createprovincia', 'Registrar Provincia')}}</p>

						@if($provincias->count())
							<table class="table table-hover table-bordered">
								<thead class="thead-inverse">
									<tr>
										<th>Provincia</th>
										<th colspan="2">Acciones</th>
									</tr>
								</thead>
								<tbody>
										@foreach ($provincias as $provincia)
										<tr>
											<td width="80%">{{$provincia->nombre}}</td>
											<td width="10%">
												{{link_to_route('editprovincia','Editar',array($provincia->id),array('class'=>'btn btn-info'))}}
											</td>
											<td width="10%">
												{{ Form::open(array('method' => 'DELETE', 'route' => array('deleteprovincia', $provincia->id))) }}                       
						                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
						                        {{ Form::close() }}
						                    </td>
					                </tr>
										@endforeach			
								</tbody>
							</table>
						@else
							No hay provincias
						@endif
						
                </div>
            </div>
        </div>
    </div>
</div>

@stop