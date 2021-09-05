<?php

namespace App\Observers\Juaso\Resource\Shipper\Agent;

use App\Models\Juaso\Resource\Shipper\Agent\Agent;

class AgentObserver
{
    /**
     * @param Agent $agent
     */
    public function creating( Agent $agent )
    {
        $agent -> resource_id = uniqid();
    }
}
