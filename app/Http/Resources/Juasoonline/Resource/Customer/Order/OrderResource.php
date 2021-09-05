<?php

namespace App\Http\Resources\Juasoonline\Resource\Customer\Order;

use App\Http\Resources\Juaso\Resource\DeliveryMethod\DeliveryMethodResource;
use App\Http\Resources\Juaso\Resource\PaymentMethod\PaymentMethodResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method relationLoaded(string $string)
 */
class OrderResource extends JsonResource
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
            'type'                          => 'Order',

            'attributes'                    =>
            [
                'resource_id'               => $this -> resource -> resource_id,
                'order_id'                  => $this -> resource -> order_id,

                'customer_id'               => $this -> resource -> customer_id,
                'address_id'                => $this -> resource -> address_id,
                'store_id'                  => $this -> resource -> store_id,

                'product_id'                => $this -> resource -> product_id,
                'color_id'                  => $this -> resource -> color_id,
                'size_id'                   => $this -> resource -> size_id,
                'bundle_id'                 => $this -> resource -> bundle_id,

                'unit_price'                => number_format( $this -> resource -> unit_price, 2 ),
                'quantity'                  => number_format( $this -> resource -> quantity,2 ),
                'subtotal'                  => $this -> resource -> subtotal,
                'coupon_amount'             => number_format( $this -> resource -> coupon_amount,2 ),
                'promo_amount'              => number_format( $this -> resource -> promo_amount,2 ),
                'total'                     => number_format( $this -> resource -> total,2 ),

                'transport_id'              => $this -> resource -> transport_id,
                'status'                    => $this -> resource -> status,

                'created_at'                => $this -> resource -> created_at -> toDateTimeString(),
                'updated_at'                => $this -> resource -> updated_at -> toDateTimeString(),
            ],

            'include'                       => $this -> when( $this -> relationLoaded( 'delivery_method' ) || $this -> relationLoaded( 'payment_method' ),
            [
                'delivery_method'           => new DeliveryMethodResource( $this -> whenLoaded( 'delivery_method' )),
                'payment_method'            => new PaymentMethodResource( $this -> whenLoaded( 'payment_method' )),
            ])
        ];
    }
}
