<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');

            $table->string('make');
            $table->string('model');
            $table->integer('milage');
            $table->string('license_plate');
            $table->string('color');
            $table->string('state');
            $table->timestamp('apk_expiration');
            $table->string('transmission');
            $table->integer('gears');
            $table->integer('engine_capicity');
            $table->integer('cylinders');
            $table->integer('empty_weight');
            $table->string('drive');
            $table->string('fuel_type');
            $table->integer('doors');
            $table->integer('seats');
            $table->integer('power');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
