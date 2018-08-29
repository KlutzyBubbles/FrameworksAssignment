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
            $table->string('rego_no', 6)->unique();
            $table->string('vin', 17)->unique();
            $table->string('make', 20);
            $table->string('model', 35);
            $table->smallInteger('year');
            $table->tinyInteger('capacity');
            $table->string('fuel_type', 8)->nullable();
            $table->string('equipment', 100)->nullable();
            $table->boolean('licence_required');
            $table->timestamps();
            $table->softDeletes();
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
