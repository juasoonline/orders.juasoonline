<?php

namespace App\Observers\Customer\Order;

use App\Models\Customer\Order\Order;

class OrderObserver
{
    /**
     * @param Order $order
     */
    public function creating( Order $order )
    {
        $order -> resource_id = generateProductID( 18 );
    }
}
