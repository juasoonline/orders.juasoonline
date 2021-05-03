<?php

namespace App\Observers\Customer;

use App\Models\Customer\Customer;

class CustomerObserver
{
    /**
     * @param Customer $customer
     */
    public function creating( Customer $customer )
    {
        $customer -> resource_id = uniqid();
    }
}
