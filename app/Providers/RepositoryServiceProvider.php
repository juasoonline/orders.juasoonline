<?php

namespace App\Providers;

use App\Repositories\Juaso\Resource\Country\CountryRepositoryInterface;
use App\Repositories\Juaso\Resource\Country\CountryRepository;
use App\Repositories\Juaso\Resource\DeliveryMethod\DeliveryMethodRepositoryInterface;
use App\Repositories\Juaso\Resource\DeliveryMethod\DeliveryMethodRepository;
use App\Repositories\Juaso\Resource\PaymentMethod\PaymentMethodRepositoryInterface;
use App\Repositories\Juaso\Resource\PaymentMethod\PaymentMethodRepository;
use App\Repositories\Juaso\Resource\Shipper\Shipper\ShipperRepositoryInterface;
use App\Repositories\Juaso\Resource\Shipper\Shipper\ShipperRepository;
use App\Repositories\Juaso\Resource\Shipper\Agent\AgentRepositoryInterface;
use App\Repositories\Juaso\Resource\Shipper\Agent\AgentRepository;
use App\Repositories\Juaso\Resource\Shipper\Transport\TransportRepositoryInterface;
use App\Repositories\Juaso\Resource\Shipper\Transport\TransportRepository;

use App\Repositories\Juasoonline\Resource\Customer\Order\OrderRepositoryInterface;
use App\Repositories\Juasoonline\Resource\Customer\Order\OrderRepository;
use App\Repositories\Juasoonline\Juaso\DeliveryMethod\JuasoonlineDeliveryMethodRepositoryInterface;
use App\Repositories\Juasoonline\Juaso\DeliveryMethod\JuasoonlineDeliveryMethodRepository;
use App\Repositories\Juasoonline\Juaso\PaymentMethod\JuasoonlinePaymentMethodRepositoryInterface;
use App\Repositories\Juasoonline\Juaso\PaymentMethod\JuasoonlinePaymentMethodRepository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Juaso and related resource
        $this -> app -> bind( CountryRepositoryInterface::class, CountryRepository::class );
        $this -> app -> bind( PaymentMethodRepositoryInterface::class, PaymentMethodRepository::class );
        $this -> app -> bind( DeliveryMethodRepositoryInterface::class, DeliveryMethodRepository::class );
        $this -> app -> bind( ShipperRepositoryInterface::class, ShipperRepository::class );
        $this -> app -> bind( AgentRepositoryInterface::class, AgentRepository::class );
        $this -> app -> bind( TransportRepositoryInterface::class, TransportRepository::class );

        // Business and related resource

        // Juasoonline and related resource
        $this -> app -> bind( OrderRepositoryInterface::class, OrderRepository::class );
        $this -> app -> bind( JuasoonlineDeliveryMethodRepositoryInterface::class, JuasoonlineDeliveryMethodRepository::class );
        $this -> app -> bind( JuasoonlinePaymentMethodRepositoryInterface::class, JuasoonlinePaymentMethodRepository::class );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
