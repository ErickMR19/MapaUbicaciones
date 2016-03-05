@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Bienvenido</div>

                <div class="panel-body">
                   @if ( date("H")  < 5 )
                        Buenas, 
                   @elseif ( date("H") < 12 )
                        <i class="fa fa-sun-o"></i> Buenos días,
                   @elseif ( date("H") < 18 )
                        <i class="fa fa-cloud"></i> Buenas tardes,
                   @else
                        <i class="fa fa-moon-o"></i> Buenas noches, 
                    @endif
                   {{ Auth::user()->name }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
