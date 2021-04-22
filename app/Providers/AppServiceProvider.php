<?php

namespace App\Providers;

use App\Models\Customer\Address\Address;
use App\Models\Customer\Cart\Cart;
use App\Models\Customer\Customer;
use App\Models\Customer\Order\Order;
use App\Models\Customer\Wishlist\Wishlist;
use App\Observers\Customer\Address\AddressObserver;
use App\Observers\Customer\Cart\CartObserver;
use App\Observers\Customer\CustomerObserver;
use App\Observers\Customer\Order\OrderObserver;
use App\Observers\Customer\Wishlist\WishlistObserver;
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
        Customer::observe( CustomerObserver::class );
        Address::observe( AddressObserver::class );
        Wishlist::observe( WishlistObserver::class );
        Cart::observe( CartObserver::class );
        Order::observe( OrderObserver::class );
    }
}
