<?php

namespace App\Observers\Juaso\Resource\DeliveryMethod;

use App\Models\Juaso\Resource\DeliveryMethod\DeliveryMethod;

class DeliveryMethodObserver
{
    /**
     * @param DeliveryMethod $deliveryFee
     */
    public function creating(DeliveryMethod $deliveryFee )
    {
        $deliveryFee -> resource_id = uniqid();
    }
}
