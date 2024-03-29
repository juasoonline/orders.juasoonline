<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function ( Blueprint $table )
        {
            $table -> bigIncrements('id');
            $table -> string('resource_id')->unique();

            $table -> string('name')->unique();
            $table -> string('currency')->unique();
            $table -> string('phone_code')->unique();
            $table -> string('iso_code')->unique();
            $table -> string('number_code')->unique();

            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
