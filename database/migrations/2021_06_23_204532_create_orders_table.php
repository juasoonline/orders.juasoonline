<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function ( Blueprint $table )
        {
            $table -> bigIncrements('id' );

            $table -> uuid( 'resource_id' ) -> unique() -> nullable( false );
            $table -> uuid( 'order_id' ) -> unique() -> nullable( false );

            $table -> unsignedBigInteger( 'customer_id' ) -> nullable( false );
            $table -> unsignedBigInteger( 'address_id' ) -> nullable( true );
            $table -> unsignedBigInteger( 'store_id' ) -> nullable( false );
            $table -> unsignedBigInteger( 'product_id' ) -> nullable( false );
            $table -> unsignedBigInteger( 'color_id' ) -> nullable( true );
            $table -> unsignedBigInteger( 'size_id' ) -> nullable( true );
            $table -> unsignedBigInteger( 'bundle_id' ) -> nullable( true );

            $table -> float( 'unit_price' ) -> nullable( true );
            $table -> integer( 'quantity' ) -> nullable( true );
            $table -> float( 'subtotal' ) -> nullable( true );
            $table -> float( 'coupon_amount' ) -> nullable( true );
            $table -> float( 'promo_amount' ) -> nullable( true );
            $table -> float( 'total' ) -> nullable( true );

            $table -> unsignedBigInteger( 'delivery_method_id' ) -> nullable( true );
            $table -> unsignedBigInteger( 'payment_method_id' ) -> nullable( true );
            $table -> unsignedBigInteger( 'transport_id' ) -> nullable( true );

            $table -> string( 'extra_data' ) -> nullable( true );

            $table -> smallInteger( 'status' ) ->default( 100 );

            $table -> timestamps();

            $table -> foreign('delivery_method_id' ) -> references('id' ) -> on( 'delivery_methods' ) -> onDelete( 'cascade' );
            $table -> foreign('payment_method_id' ) -> references('id' ) -> on( 'payment_methods' ) -> onDelete( 'cascade' );
            $table -> foreign('transport_id' ) -> references('id' ) -> on( 'transports' ) -> onDelete( 'cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
