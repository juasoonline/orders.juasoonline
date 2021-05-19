<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function ( Blueprint $table )
        {
            $table -> bigIncrements('id' );
            $table -> uuid( 'resource_id' ) -> unique() -> nullable( false );

            $table -> string('first_name' ) -> nullable( false );
            $table -> string('middle_name' ) -> nullable();
            $table -> string('last_name' ) -> nullable( false );

            $table -> string('gender' ) -> nullable();
            $table -> date('date_of_birth' ) -> nullable();
            $table -> string( 'image' ) -> nullable( true );

            $table -> string('email', 50 ) -> nullable( false ) -> unique();
            $table -> string('mobile_phone', 20 ) -> nullable( false ) -> unique();

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
        Schema::dropIfExists('customers');
    }
}
