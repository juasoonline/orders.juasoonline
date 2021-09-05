<?php

namespace App\Providers;

use App\Models\Juaso\Resource\Country\Country;
use App\Observers\Juaso\Resource\Country\CountryObserver;
use App\Models\Juaso\Resource\PaymentMethod\PaymentMethod;
use App\Observers\Juaso\Resource\PaymentMethod\PaymentMethodObserver;
use App\Models\Juaso\Resource\DeliveryMethod\DeliveryMethod;
use App\Observers\Juaso\Resource\DeliveryMethod\DeliveryMethodObserver;
use App\Models\Juaso\Resource\Shipper\Shipper\Shipper;
use App\Observers\Juaso\Resource\Shipper\Shipper\ShipperObserver;
use App\Models\Juaso\Resource\Shipper\Agent\Agent;
use App\Observers\Juaso\Resource\Shipper\Agent\AgentObserver;
use App\Models\Juaso\Resource\Shipper\Transport\Transport;
use App\Observers\Juaso\Resource\Shipper\Transport\TransportObserver;

use App\Models\Juasoonline\Resource\Customer\Order\Order;
use App\Observers\Juasoonline\Resource\Customer\Order\OrderObserver;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Juaso and related observers
        Country::observe( CountryObserver::class );
        PaymentMethod::observe( PaymentMethodObserver::class );
        DeliveryMethod::observe( DeliveryMethodObserver::class );
        Shipper::observe( ShipperObserver::class );
        Agent::observe( AgentObserver::class );
        Transport::observe( TransportObserver::class );

        // Business and related observers

        // Juasoonline and related observers
        Order::observe( OrderObserver::class );
    }
}
