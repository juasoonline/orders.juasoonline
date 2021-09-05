<?php

namespace App\Http\Resources\Juaso\Resource\Shipper\Agent;

use App\Http\Resources\Juaso\Resource\Shipper\Shipper\ShipperResource;
use App\Http\Resources\Juaso\Resource\Shipper\Transport\TransportResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method relationLoaded(string $string)
 */
class AgentResource extends JsonResource
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
            'type'                  => 'Agent',

            'attributes'            =>
            [
                'resource_id'       => $this -> resource -> resource_id,

                'first_name'        => $this -> resource -> first_name,
                'middle_name'       => $this -> resource -> middle_name,
                'last_name'         => $this -> resource -> last_name,

                'gender'            => $this -> resource -> gender,
                'date_of_birth'     => $this -> resource -> date_of_birth,
                'image'             => $this -> resource -> image,

                'email'             => $this -> resource -> email,
                'mobile_phone'      => $this -> resource -> mobile_phone,

                'created_at'        => $this -> resource -> created_at -> toDateTimeString(),
                'updated_at'        => $this -> resource -> updated_at -> toDateTimeString(),
            ],

            'include'               => $this -> when( $this -> relationLoaded( 'shipper' ) || $this -> relationLoaded( 'transport' ),
            [
                'shipper'           => new ShipperResource( $this -> whenLoaded( 'shipper' )),
                'transport'         => new TransportResource( $this -> whenLoaded( 'transport' )),
            ])
        ];
    }
}
