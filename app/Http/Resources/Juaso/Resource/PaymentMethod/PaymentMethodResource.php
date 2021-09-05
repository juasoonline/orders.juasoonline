<?php

namespace App\Http\Resources\Juaso\Resource\PaymentMethod;

use App\Http\Resources\Juasoonline\Resource\Customer\Order\OrderResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method relationLoaded( string $string )
 */
class PaymentMethodResource extends JsonResource
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
            'type'                  => 'PaymentMethods',

            'attributes' =>
            [
                'resource_id'       => $this -> resource -> resource_id,

                'name'              => $this -> resource -> name,
                'code'              => $this -> resource -> code,
                'description'       => $this -> resource -> description,
                'logo'              => $this -> resource -> logo,

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
