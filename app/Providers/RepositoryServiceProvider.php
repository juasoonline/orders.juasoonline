<?php

namespace App\Providers;

use App\Repositories\Customer\Address\AddressRepository;
use App\Repositories\Customer\Address\AddressRepositoryInterface;
use App\Repositories\Customer\Cart\CartRepository;
use App\Repositories\Customer\Cart\CartRepositoryInterface;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Customer\Order\OrderRepository;
use App\Repositories\Customer\Order\OrderRepositoryInterface;
use App\Repositories\Customer\Wishlist\WishlistRepository;
use App\Repositories\Customer\Wishlist\WishlistRepositoryInterface;
use App\Repositories\Others\DeliveryFee\DeliveryFeeRepository;
use App\Repositories\Others\DeliveryFee\DeliveryFeeRepositoryInterface;
use App\Repositories\Others\PaymentMethod\PaymentMethodRepository;
use App\Repositories\Others\PaymentMethod\PaymentMethodRepositoryInterface;
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
        // Customer and related resource repository
        $this -> app -> bind( CustomerRepositoryInterface::class, CustomerRepository::class );
        $this -> app -> bind( AddressRepositoryInterface::class, AddressRepository::class );
        $this -> app -> bind( CartRepositoryInterface::class, CartRepository::class );
        $this -> app -> bind( WishlistRepositoryInterface::class, WishlistRepository::class );
        $this -> app -> bind( OrderRepositoryInterface::class, OrderRepository::class );

        // Other resource repository
        $this -> app -> bind( PaymentMethodRepositoryInterface::class, PaymentMethodRepository::class );
        $this -> app -> bind( DeliveryFeeRepositoryInterface::class, DeliveryFeeRepository::class );
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
