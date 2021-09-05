<?php

namespace App\Http\Resources\Juaso\Resource\Shipper\Transport;

use App\Http\Resources\Juaso\Resource\Shipper\Agent\AgentResource;
use App\Http\Resources\Juaso\Resource\Shipper\Shipper\ShipperResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method relationLoaded(string $string)
 */
class TransportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray( $request ) : array
    {
        return
        [
            'id'                            => $this -> resource -> id,
            'type'                          => 'Transport',

            'attributes'                    =>
            [
                'resource_id'               => $this -> resource -> resource_id,

                'name'                      => $this -> resource -> name,
                'registration_number'       => $this -> resource -> registration_number,

                'created_at'                => $this -> resource -> created_at -> toDateTimeString(),
                'updated_at'                => $this -> resource -> updated_at -> toDateTimeString(),
            ],

            'include'                       => $this -> when( $this -> relationLoaded( 'shipper' ) || $this -> relationLoaded( 'agent' ),
            [
                'shipper'                   => new ShipperResource( $this -> whenLoaded( 'shipper' )),
                'agent'                     => new AgentResource( $this -> whenLoaded( 'agent' )),
            ])
        ];
    }
}
