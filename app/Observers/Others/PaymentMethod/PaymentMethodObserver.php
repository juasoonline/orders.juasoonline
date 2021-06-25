<?php

namespace App\Observers\Others\PaymentMethod;

use App\Models\Others\PaymentMethod\PaymentMethod;

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
