<?php

namespace App\Http\Resources\Juaso\Resource\Country;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method relationLoaded( string $string )
 */
class CountryResource extends JsonResource
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
            'types'                 => 'Country',

            'attributes' =>
            [
                'resource_id'       => $this -> resource -> resource_id,

                'name'              => $this -> resource -> name,
                'iso_code'          => $this -> resource -> iso_code,
                'phone_code'        => $this -> resource -> phone_code,
                'currency'          => $this -> resource -> currency
            ],

            'include'               => $this -> when( $this -> relationLoaded( '' ),
            [
            ])
        ];

    }
}
