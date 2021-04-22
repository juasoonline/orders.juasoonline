<?php

namespace App\Models\Customer;

use App\Models\Customer\Address\Address;
use App\Models\Customer\Wishlist\Wishlist;
use App\Models\Customer\Cart\Cart;
use App\Models\Customer\Order\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [ 'id' ];

    /**
     * @return string
     */
    public function getRouteKeyName () : string { return 'resource_id'; }

    /**
     * @return HasMany
     */
    public function addresses(): HasMany
    {
        return $this -> hasMany( Address::class );
    }

    /**
     * @return HasMany
     */
    public function wishlists(): HasMany
    {
        return $this -> hasMany( Wishlist::class );
    }

    /**
     * @return HasMany
     */
    public function carts(): HasMany
    {
        return $this -> hasMany( Cart::class );
    }

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this -> hasMany( Order::class );
    }
}
