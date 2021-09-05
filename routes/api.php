<?php

use App\Http\Controllers\Juaso\Resource\Country\CountryController;
use App\Http\Controllers\Juaso\Resource\PaymentMethod\PaymentMethodController;
use App\Http\Controllers\Juaso\Resource\DeliveryMethod\DeliveryMethodController;
use App\Http\Controllers\Juaso\Resource\Shipper\Shipper\ShipperController;
use App\Http\Controllers\Juaso\Resource\Shipper\Agent\AgentController;
use App\Http\Controllers\Juaso\Resource\Shipper\Transport\TransportController;

use App\Http\Controllers\Juasoonline\Resource\Customer\Order\OrderController;

use App\Http\Controllers\Juasoonline\Juaso\DeliveryMethod\JuasoonlineDeliveryMethodController;
use App\Http\Controllers\Juasoonline\Juaso\PaymentMethod\JuasoonlinePaymentMethodController;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/v1'], function ()
{
    // Business resource routes
    Route::group(['prefix' => 'juaso'], function ()
    {
        // juaso and related routes
        Route::group(['prefix' => 'resources'], function ()
        {
            Route::apiResource('countries', CountryController::class );
            Route::apiResource('payment-methods', PaymentMethodController::class );
            Route::apiResource('delivery-methods', DeliveryMethodController::class );

            // Shippers and related resource
            Route::apiResource('shippers', ShipperController::class );
            Route::apiResource('shippers.agents', AgentController::class );
            Route::apiResource('shippers.transports', TransportController::class );
        });

        // Business and related routes
        Route::group(['prefix' => 'business'], function()
        {

        });

        // juasoonline and related routes
        Route::group(['prefix' => 'juasoonline'], function()
        {

        });
    });

    // Business resource routes
    Route::group(['prefix' => 'business'], function ()
    {
        // juaso and related routes
        Route::group(['prefix' => 'resources'], function ()
        {

        });

        // Business and related routes
        Route::group(['prefix' => 'business'], function()
        {

        });

        // juasoonline and related routes
        Route::group(['prefix' => 'juasoonline'], function()
        {

        });
    });

    // Juasoonline resource routes
    Route::group(['prefix' => 'juasoonline'], function ()
    {
        // Customer and related routes
        Route::group(['prefix' => 'customers'], function ()
        {
            Route::get( '{customer}/orders', [ OrderController::class, 'index' ]);
            Route::post( 'orders', [ OrderController::class, 'store' ]);
            Route::get( '{customer}/orders/{order}', [ OrderController::class, 'show' ]);
        });

        // Business and related routes
        Route::group(['prefix' => 'business'], function()
        {

        });

        // juaso and related routes
        Route::group(['prefix' => 'juaso/resources'], function()
        {
            Route::apiResource( 'delivery-methods', JuasoonlineDeliveryMethodController::class ) -> only( 'index', 'show' );
            Route::apiResource( 'payment-methods', JuasoonlinePaymentMethodController::class ) -> only( 'index', 'show' );
        });
    });
});
