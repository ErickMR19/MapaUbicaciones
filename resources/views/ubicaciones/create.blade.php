@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 align="center">Agregar Ubicación</h3> {{ Form::open(array('route' => 'storeubicacion')) }}
                    <div class="form-group">
                        {{ Form::label('nombre', 'Nombre:') }} {{ Form::text('nombre',null,array('class'=> 'form-control')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('telefono', 'Teléfono:') }} {{ Form::text('telefono',null,array('class'=> 'form-control')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('web', 'Página Web:') }} {{ Form::text('web',null,array('class'=> 'form-control')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('categories_id', 'Categoría:') }} {{ Form::select('categories_id',$categoria,null,array('class'=> 'form-control'))}}
                    </div>

                    <div class="form-group">
                        {{ Form::label('distrito_id', 'Provincia,Cantón y Distrito:') }} {{ Form::select('distrito_id',$distrito,null,array('class'=> 'form-control'))}}
                    </div>

                    <div id="mapa" style="width: 100%; height: 400px;">
                        --Cargando Mapa--<i class="fa fa-spinner fa-pulse"></i>
                    </div>

                    <div class="form-group">
                        {{ Form::label('latitude', 'Latitude:') }} {{ Form::text('latitude',null,array('class'=> 'form-control', 'readonly' => 'true')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('longitude', 'Longitude:') }} {{ Form::text('longitude',null,array('class'=> 'form-control', 'readonly' => 'true')) }}
                    </div>

                    <div align="center">
                        {{ Form::submit('Agregar', array('class' => 'btn btn-info')) }}
                    </div>

                    {{ Form::close() }} @if ($errors->any())
                    <span class="help-inline" style="color:red">*{{ implode('', $errors->all(':message')) }}</span> @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop @section('scripts')
<script type="text/javascript">
    var divMapa = document.getElementById('mapa');

    var lat = 9.93203265,
        lon = -84.1810421;

    function cargarMapa() {
        if ("geolocation" in navigator) {
            var options = {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
            };

            function success(pos) {
                var staAnaBounds = new google.maps.LatLngBounds(
                    new google.maps.LatLng(9.862, -84.246),
                    new google.maps.LatLng(9.975, -84.145)
                );
                console.log(pos);
                gLatLon = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
                if (staAnaBounds.contains(gLatLon)) {
                    lat = pos.coords.latitude;
                    lon = pos.coords.longitude;
                }
                crearMapa();

            };

            function error(err) {
                console.warn('ERROR(' + err.code + '): ' + err.message);
                crearMapa();
            };

            navigator.geolocation.getCurrentPosition(success, error, options);
        }
        else {
            crearMapa();
        }



    }
    window.onload = cargarMapa;


    function crearMapa() {

        var gLatLon = new google.maps.LatLng(lat, lon);
        var objConfig = {
            zoom: 15,
            center: gLatLon
        }
        var gMapa = new google.maps.Map(divMapa, objConfig);
        var objConfigMarker = {
            position: gLatLon,
            map: gMapa,
            draggable: true,
            animation: google.maps.Animation.DROP,
            title: "Elija la ubicación del lugar"
        }
        var gMarker = new google.maps.Marker(objConfigMarker);

        google.maps.event.addListener(gMarker, 'dragend', function() {


            var lat = gMarker.getPosition().lat();
            var lngi = gMarker.getPosition().lng();


            document.getElementById("latitude").value = String(lat).substring(0, 10);
            document.getElementById("longitude").value = String(lngi).substring(0, 11);
        });
    }
</script>
@stop