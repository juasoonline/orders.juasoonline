<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippers', function ( Blueprint $table )
        {
            $table -> bigIncrements('id' );
            $table -> uuid( 'resource_id' ) -> unique() -> nullable( false );

            $table -> string( 'name' ) -> nullable( false ) -> unique();
            $table -> string( 'doing_business_as' ) -> nullable( false ) -> unique();

            $table -> string( 'region' );
            $table -> string( 'city' );
            $table -> string( 'address' );
            $table -> string( 'postal_code' );

            $table -> string( 'mobile_phone' ) -> nullable( false ) -> unique();
            $table -> string( 'other_phone' );

            $table -> string( 'website' ) -> nullable( true ) -> unique();
            $table -> string( 'email' ) -> nullable( true ) -> unique();

            $table -> timestamps();
            $table -> softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shippers');
    }
}
