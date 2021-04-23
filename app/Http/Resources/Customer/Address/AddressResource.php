<?php

namespace App\Http\Resources\Customer\Address;

use App\Http\Resources\Customer\CustomerResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method relationLoaded( string $string )
 */
class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|mixed
     */
    public function toArray( $request ) : array
    {
        return
        [
            'id'                    => $this -> id,
            'type'                  => 'Address',

            'attributes' =>
            [
                'resource_id'       => $this -> resource_id,

                'type'              => $this -> type,
                'country'           => $this -> country,
                'region'            => $this -> region,
                'city'              => $this -> city,
                'street_name'       => $this -> street_name,
                'postal_code'       => $this -> postal_code,

                'created_at'        => $this -> created_at -> toDateTimeString(),
                'updated_at'        => $this -> updated_at -> toDateTimeString(),
            ],

            'include'               => $this -> when( $this -> relationLoaded( 'customer' ),
            [
                'customer'          => new CustomerResource( $this -> whenLoaded( 'customer' ) ),
            ])
        ];
    }
}
