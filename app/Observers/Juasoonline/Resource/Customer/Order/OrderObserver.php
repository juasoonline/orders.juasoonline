<?php

namespace App\Observers\Juasoonline\Resource\Customer\Order;

use App\Models\Juasoonline\Resource\Customer\Order\Order;

class OrderObserver
{
    /**
     * @param Order $order
     */
    public function creating( Order $order )
    {
        $order -> resource_id = uniqid();
        $order -> order_id = generateOrderID( 12 );
    }
}
