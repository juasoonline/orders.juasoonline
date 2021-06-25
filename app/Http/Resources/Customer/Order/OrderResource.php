<?php

namespace App\Http\Resources\Customer\Order;

use App\Http\Resources\Customer\CustomerResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method relationLoaded( string $string )
 */
class OrderResource extends JsonResource
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
            'id'                    => $this -> resource ->  id,
            'type'                  => 'Order',

            'attributes' =>
            [
                'resource_id'       => $this -> resource -> resource_id,

                'product_id'        => $this -> resource -> product_id,
                'color_id'          => $this -> resource -> color_id,
                'size_id'           => $this -> resource -> size_id,

                'quantity'          => $this -> resource -> quantity,

                'subtotal'          => number_format( $this -> resource -> subtotal, 2 ),
                'coupon_amount'     => number_format( $this -> resource -> coupon_amount, 2 ),
                'promo_amount'      => number_format( $this -> resource -> promo_amount, 2 ),
                'delivery_fee'      => number_format( $this -> resource -> delivery_fee, 2 ),
                'total'             => number_format( $this -> resource -> total, 2 ),

                'created_at'        => $this -> resource -> created_at -> toDateTimeString(),
                'updated_at'        => $this -> resource -> updated_at -> toDateTimeString(),
            ],

            'include'               => $this -> when( $this -> relationLoaded( 'customer' ),
            [
                'customer'          => new CustomerResource( $this -> whenLoaded( 'customer' ) ),
            ])
        ];
    }
}
