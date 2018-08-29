<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 35);
            $table->char('middle_initial', 1)->nullable();
            $table->string('last_name', 35);
            $table->smallInteger('street_no');
            $table->string('street_name', 50);
            $table->string('suburb', 35);
            $table->smallInteger('postcode');
            $table->string('email', 150);
            $table->string('auth', 256);
            $table->string('phone', 10)->nullable();
            $table->boolean('auth_customer')->default(false);
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
        Schema::dropIfExists('customers');
    }
}
