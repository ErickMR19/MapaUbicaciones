@extends('layouts.app')

@section('content')
	<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
					<h3>Lista de Categorías</h3>
						<p>{{link_to_route('createcategoria', 'Registrar Categoría')}}</p>

						@if($categorias->count())
							<table class="table table-hover table-bordered">
								<thead class="thead-inverse">
									<tr>
										<th>Categoría</th>
										<th colspan="2">Acciones</th>
									</tr>
								</thead>
								<tbody>
										@foreach ($categorias as $categoria)
										<tr>
											<td width="80%">{{$categoria->descripcion}}</td>
											<td width="10%">
												{{link_to_route('editcategoria','Editar',array($categoria->id),array('class'=>'btn btn-info'))}}
											</td>
											<td width="10%">
												{{ Form::open(array('method' => 'DELETE', 'route' => array('deletecategoria', $categoria->id))) }}                       
						                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
						                        {{ Form::close() }}
						                    </td>
					                </tr>
										@endforeach			
								</tbody>
							</table>
						@else
							No hay categorías
						@endif
						
                </div>
            </div>
        </div>
    </div>
</div>

@stop