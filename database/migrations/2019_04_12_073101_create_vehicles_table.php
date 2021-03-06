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

            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->integer('mileage')->nullable();
            $table->string('license_plate')->nullable();
            $table->year('year')->nullable();
            $table->string('color')->nullable();
            $table->string('state')->nullable();
            $table->string('body_type')->nullable();
            $table->date('apk_expiration')->nullable();
            $table->string('transmission')->nullable();
            $table->integer('gears')->nullable();
            $table->integer('engine_capicity')->nullable();
            $table->integer('cylinders')->nullable();
            $table->integer('empty_weight')->nullable();
            $table->string('drive')->nullable();
            $table->string('fuel_type')->nullable();
            $table->integer('doors')->nullable();
            $table->integer('seats')->nullable();
            $table->integer('power')->nullable();

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
