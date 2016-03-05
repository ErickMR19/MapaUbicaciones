<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distritos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('canton_id')->unsigned()->index();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::table('distritos', function (Blueprint $table) {
        $table->foreign('canton_id')->references('id')->on('cantones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('distritos');
    }
}
