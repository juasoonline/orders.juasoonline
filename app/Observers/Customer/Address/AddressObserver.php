<?php

namespace App\Observers\Customer\Address;

use App\Models\Customer\Address\Address;

class AddressObserver
{
    /**
     * @param Address $address
     */
    public function creating( Address $address )
    {
        $address -> resource_id = uniqid();
    }
}
