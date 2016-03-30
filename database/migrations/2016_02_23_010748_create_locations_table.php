<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->engine = 'MYISAM';
            $table->increments('id');
            $table->string('nombre');
            $table->string('telefono')->default(' ');
            $table->string('web')->nullable();
            $table->integer('categories_id')->unsigned()->index();
            $table->integer('distrito_id')->unsigned()->index();
            $table->decimal('latitude', 10, 8); 
            $table->decimal('longitude', 11, 8);
            $table->timestamps();
        });

        Schema::table('locations', function (Blueprint $table) {
        $table->foreign('categories_id')->references('id')->on('categories');
        $table->foreign('distrito_id')->references('id')->on('distritos');
        });
          /*Espatial Column*/
    DB::statement('ALTER TABLE locations ADD geometria POINT NOT NULL' );
    /*Espatial index (MYISAM only)*/
    DB::statement( 'ALTER TABLE locations ADD SPATIAL INDEX index_point(geometria)' );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('locations');
    }
}
