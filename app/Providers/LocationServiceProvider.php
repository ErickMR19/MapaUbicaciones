<?php

namespace MapaUbicaciones\Providers;

use Illuminate\Support\ServiceProvider;

class LocationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    protected $defer =true;
    public function boot()
    {
        /**
        parent::boot();
        static::create(function($ubicacion)
        {

            if(isset($ubicacion->latitude, $ubicacion->longitude))
            {
                $point = $ubicacion->geoToPoint($ubicacion->latitude, $ubicacion->longitude);
                $ubicacion->setAttribute('geometria',  DB::raw("GeomFromText('POINT(" . $point . ")')") );
            }

        });

        static::updated(function($ubicacion){

            if(isset($ubicacion->latitude, $ubicacion->longitude)){
                $point = $ubicacion->geoToPoint($ubicacion->latitude, $ubicacion->longitude);
                DB::statement("UPDATE " . $ubicacion->getTable() . " SET location = GeomFromText('POINT(" . $point . ")') WHERE id = ". $ubicacion->id);
            }

        });
        **/
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
