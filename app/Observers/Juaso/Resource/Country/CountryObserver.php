<?php

namespace App\Observers\Juaso\Resource\Country;

use App\Models\Juaso\Resource\Country\Country;

class CountryObserver
{
    /**
     * @param Country $country
     */
    public function creating( Country $country )
    {
        $country -> resource_id = uniqid();
    }
}
