@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
					<h3 align="center">Modificar Ubicación</h3>
					{{ Form::model($ubicacion, array('method' => 'PUT', 'route' => array('updateubicacion',$ubicacion->id))) }}
						<div class="form-group">
						{{ Form::label('nombre', 'Nombre:') }}
						{{ Form::text('nombre',null,array('class'=> 'form-control')) }}	
						</div>
						
						<div class="form-group">
						{{ Form::label('telefono', 'Teléfono:') }}
						{{ Form::text('telefono',null,array('class'=> 'form-control')) }}	
						</div>
						
						<div class="form-group">
						{{ Form::label('web', 'Página Web:') }}
						{{ Form::text('web',null,array('class'=> 'form-control')) }}	
						</div>

                        <div class="form-group">
                            {{ Form::label('categories_id', 'Categoría:') }}
                            {{ Form::select('categories_id',$categoria,$ubicacion->categories_id,array('class'=> 'form-control'))}}
                        </div>

                        <div class="form-group">
                            {{ Form::label('distrito:id', 'Provincia,Cantón y Distrito:') }}
                            {{ Form::select('distrito_id',$distrito,$ubicacion->distrito_id,array('class'=> 'form-control'))}}
                        </div>

                        <div id="mapa" style="width: 100%; height: 400px;">
                            --Cargando Mapa--
                        </div>

					    <div class="form-group">
						{{ Form::label('latitude', 'Latitude:') }}
						{{ Form::text('latitude',null,array('class'=> 'form-control', 'readonly' => 'true')) }}	
                        </div>

                        <div class="form-group">
                        {{ Form::label('longitude', 'Longitude:') }}
                        {{ Form::text('longitude',null,array('class'=> 'form-control', 'readonly' => 'true')) }}   
						</div>
					
			           	<div align="center">
			           		{{ Form::submit('Actualizar', array('class' => 'btn btn-info')) }}    
                            {{ link_to_route('indexubicacion', 'Cancelar', $ubicacion->id=0, array('class' => 'btn btn-danger')) }} 
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


@section('scripts')
    <script type="text/javascript">
        window.onload = cargarMapa;
        var divMapa = document.getElementById('mapa');

        function cargarMapa()
        {
            var lat = document.getElementById('latitude').value;
            var lon = document.getElementById('longitude').value;

            var gLatLon = new google.maps.LatLng(lat,lon);
            var objConfig = {
                zoom: 15,
                center: gLatLon
            }
            var gMapa = new google.maps.Map(divMapa,objConfig);
            var objConfigMarker = {
                position:gLatLon,
                map: gMapa,
                draggable: true,
                animation: google.maps.Animation.DROP,
                title: "Elija la ubicación del lugar"
            }
            var gMarker = new google.maps.Marker(objConfigMarker);

            google.maps.event.addListener(gMarker,'dragend',function(){


                var lat = gMarker.getPosition().lat();
                var lngi = gMarker.getPosition().lng();


                document.getElementById("latitude").value = String(lat).substring(0,10);
                document.getElementById("longitude").value = String(lngi).substring(0,11);
            });
        }
    </script>
@stop