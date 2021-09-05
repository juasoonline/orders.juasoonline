<?php

namespace App\Observers\Juaso\Resource\Shipper\Transport;

use App\Models\Juaso\Resource\Shipper\Transport\Transport;

class TransportObserver
{
    /**
     * @param Transport $transport
     */
    public function creating( Transport $transport )
    {
        $transport -> resource_id = uniqid();
    }
}
