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
        $this -> app -> bind( CustomerRepositoryInterface::class, CustomerRepository::class );
        $this -> app -> bind( AddressRepositoryInterface::class, AddressRepository::class );
        $this -> app -> bind( CartRepositoryInterface::class, CartRepository::class );
        $this -> app -> bind( WishlistRepositoryInterface::class, WishlistRepository::class );
        $this -> app -> bind( OrderRepositoryInterface::class, OrderRepository::class );
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
