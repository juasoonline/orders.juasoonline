<?php

namespace App\Http\Resources\Customer\Cart;

use App\Http\Resources\Customer\CustomerResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method relationLoaded( string $string )
 */
class CartResource extends JsonResource
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
            'type'                  => 'Cart',

            'attributes' =>
            [
                'resource_id'       => $this -> resource_id,

                'product_id'        => $this -> product_id,
                'quantity'          => $this -> quantity,

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
