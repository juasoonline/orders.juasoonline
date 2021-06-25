<?php

use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\Address\AddressController;
use App\Http\Controllers\Customer\Wishlist\WishlistController;
use App\Http\Controllers\Customer\Cart\CartController;
use App\Http\Controllers\Customer\Order\OrderController;

use App\Http\Controllers\Others\PaymentMethod\PaymentMethodController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([], function ()
{
    // Customers routes
    Route::group([], function()
    {
        Route::apiResource( 'customers', CustomerController::class, [ 'parameters' => [ '' => 'customer' ]] );
        Route::apiResource( 'customer.addresses', AddressController::class );
        Route::apiResource( 'customer.wishlists', WishlistController::class );
        Route::apiResource( 'customer.carts', CartController::class );
        Route::apiResource( 'customer.orders', OrderController::class );
    });

    // Juasoonline resources routes
    Route::group(['prefix' => 'juaso'], function ()
    {
        Route::apiResource( 'payment-methods', PaymentMethodController::class );
    });
});
