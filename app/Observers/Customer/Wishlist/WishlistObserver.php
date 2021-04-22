<?php

namespace App\Observers\Customer\Wishlist;

use App\Models\Customer\Wishlist\Wishlist;

class WishlistObserver
{
    /**
     * @param Wishlist $wishlist
     */
    public function creating( Wishlist $wishlist )
    {
        $wishlist -> resource_id = uniqid();
    }
}
