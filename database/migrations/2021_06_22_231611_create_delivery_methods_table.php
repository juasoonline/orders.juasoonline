<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_methods', function ( Blueprint $table )
        {
            $table -> bigIncrements('id' );

            $table -> uuid( 'resource_id' ) -> unique() -> nullable( false );

            $table -> string( 'delivery_time' ) -> nullable( false ) -> unique();
            $table -> float( 'fee' ) -> nullable( true );
            $table -> string( 'carrier' ) -> nullable( true);
            $table -> string( 'description' ) -> nullable( true);

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
        Schema::dropIfExists('delivery_methods');
    }
}
