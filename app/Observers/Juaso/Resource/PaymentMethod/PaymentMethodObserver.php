<?php

namespace App\Observers\Juaso\Resource\PaymentMethod;

use App\Models\Juaso\Resource\PaymentMethod\PaymentMethod;

class PaymentMethodObserver
{
    /**
     * @param PaymentMethod $paymentMethod
     */
    public function creating( PaymentMethod $paymentMethod )
    {
        $paymentMethod -> resource_id = uniqid();
    }
}
