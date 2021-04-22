<?php

namespace App\Observers\Customer\Cart;

use App\Models\Customer\Cart\Cart;

class CartObserver
{
    /**
     * @param Cart $cart
     */
    public function creating( Cart $cart )
    {
        $cart -> resource_id = uniqid();
    }
}
