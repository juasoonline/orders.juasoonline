<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transports', function ( Blueprint $table )
        {
            $table -> bigIncrements('id' );
            $table -> uuid( 'resource_id' ) -> unique() -> nullable( false );

            $table -> unsignedBigInteger( 'shipper_id' ) -> nullable( false );
            $table -> unsignedBigInteger( 'agent_id' ) -> nullable( true );

            $table -> string( 'name' ) -> nullable( false ) -> unique();
            $table -> string( 'registration_number' ) -> nullable( false ) -> unique();

            $table -> timestamps();
            $table -> softDeletes();

            $table -> foreign('shipper_id' ) -> references('id' ) -> on( 'shippers' ) -> onDelete( 'cascade' );
            $table -> foreign('agent_id' ) -> references('id' ) -> on( 'agents' ) -> onDelete( 'cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transports');
    }
}
