<?php

namespace App\Http\Resources\Juaso\Resource\Shipper\Shipper;

use App\Http\Resources\Juaso\Resource\Shipper\Agent\AgentResource;
use App\Http\Resources\Juaso\Resource\Shipper\Transport\TransportResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method relationLoaded(string $string)
 */
class ShipperResource extends JsonResource
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
            'id'                    => $this -> resource -> id,
            'type'                  => 'Shipper',

            'attributes' =>
            [
                'resource_id'       => $this -> resource -> resource_id,

                'name'              => $this -> resource -> name,
                'doing_business_as' => $this -> resource -> doing_business_as,

                'region'            => $this -> resource -> region,
                'city'              => $this -> resource -> city,
                'address'           => $this -> resource -> address,
                'postal_code'       => $this -> resource -> postal_code,

                'mobile_phone'      => $this -> resource -> mobile_phone,
                'other_phone'       => $this -> resource -> other_phone,

                'email'             => $this -> resource -> email,
                'website'           => $this -> resource -> website,

                'created_at'        => $this -> resource -> created_at -> toDateTimeString(),
                'updated_at'        => $this -> resource -> updated_at -> toDateTimeString(),
            ],

            'include'               => $this -> when( $this -> relationLoaded( 'agents' ) || $this -> relationLoaded( 'transports' ),
            [
                'agents'            => AgentResource::collection( $this -> whenLoaded( 'agents' )),
                'transports'        => TransportResource::collection( $this -> whenLoaded( 'transports' )),
            ])
        ];
    }
}
