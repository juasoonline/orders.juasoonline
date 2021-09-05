<?php

namespace App\Observers\Juaso\Resource\Shipper\Shipper;

use App\Models\Juaso\Resource\Shipper\Shipper\Shipper;

class ShipperObserver
{
    /**
     * @param Shipper $shipper
     */
    public function creating( Shipper $shipper )
    {
        $shipper -> resource_id = uniqid();
    }
}
