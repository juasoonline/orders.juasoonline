<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function ( Blueprint $table )
        {
            $table -> bigIncrements('id' );

            $table -> uuid( 'resource_id' ) -> unique() -> nullable( false );

            $table -> unsignedBigInteger( 'customer_id' ) -> nullable( false );

            $table -> string( 'product_id' ) -> nullable( false );
            $table -> string( 'color_id' ) -> nullable( true );
            $table -> string( 'size_id' ) -> nullable( true );
            $table -> string( 'bundle_id' ) -> nullable( true );

            $table -> integer( 'quantity' ) -> nullable( true );

            $table -> float( 'subtotal' ) -> nullable( true );
            $table -> float( 'coupon_amount' ) -> nullable( true );
            $table -> float( 'promo_amount' ) -> nullable( true );
            $table -> float( 'delivery_fee' ) -> nullable( true );
            $table -> float( 'total' ) -> nullable( true );

            $table -> string( 'extra_data' ) -> nullable( true );

            $table -> timestamps();

            $table -> foreign('customer_id' ) -> references('id' ) -> on( 'customers' ) -> onDelete( 'cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
