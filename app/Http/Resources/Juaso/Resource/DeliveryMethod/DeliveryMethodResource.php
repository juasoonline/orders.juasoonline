<?php

namespace App\Http\Resources\Juaso\Resource\DeliveryMethod;

use App\Http\Resources\Juasoonline\Resource\Customer\Order\OrderResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method relationLoaded( string $string )
 */
class DeliveryMethodResource extends JsonResource
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
            'type'                  => 'DeliveryMethod',

            'attributes' =>
            [
                'resource_id'       => $this -> resource -> resource_id,

                'delivery_time'     => $this -> resource -> delivery_time,
                'fee'               => $this -> resource -> fee,
                'carrier'           => $this -> resource -> carrier,
                'description'       => $this -> resource -> description,

                'created_at'        => $this -> resource -> created_at -> toDateTimeString(),
                'updated_at'        => $this -> resource -> updated_at -> toDateTimeString(),
            ],

            'include'               => $this -> when( $this -> relationLoaded( 'orders' ),
            [
                'orders'            => OrderResource::collection( $this -> whenLoaded( 'orders' ) ),
            ])
        ];
    }
}
