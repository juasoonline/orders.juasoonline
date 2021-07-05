<?php

namespace App\Observers\Others\DeliveryFee;

use App\Models\Others\DeliveryFee\DeliveryFee;

class DeliveryFeeObserver
{
    /**
     * @param DeliveryFee $deliveryFee
     */
    public function creating( DeliveryFee $deliveryFee )
    {
        $deliveryFee -> resource_id = uniqid();
    }
}
