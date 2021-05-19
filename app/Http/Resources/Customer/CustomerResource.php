<?php

namespace App\Http\Resources\Customer;

use App\Http\Resources\Customer\Address\AddressResource;
use App\Http\Resources\Customer\Cart\CartResource;
use App\Http\Resources\Customer\Order\OrderResource;
use App\Http\Resources\Customer\Wishlist\WishlistResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method relationLoaded( string $string )
 */
class CustomerResource extends JsonResource
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
            'type'                  => 'Customer',

            'attributes' =>
            [
                'resource_id'       => $this -> resource_id,

                'first_name'        => $this -> first_name,
                'middle_name'       => $this -> middle_name,
                'last_name'         => $this -> last_name,

                'gender'            => $this -> gender,
                'date_of_birth'     => $this -> date_of_birth,
                'image'             => $this -> image,

                'email'             => $this -> email,
                'mobile_phone'      => $this -> mobile_phone,

                'created_at'        => $this -> created_at -> toDateTimeString(),
                'updated_at'        => $this -> updated_at -> toDateTimeString(),
            ],

            'include'               => $this -> when( $this -> relationLoaded( 'addresses' ) || $this -> relationLoaded( 'wishlists' ) || $this -> relationLoaded( 'carts' ) || $this -> relationLoaded( 'orders' ),
            [
                'addresses'         => AddressResource::collection( $this -> whenLoaded( 'addresses' ) ),
                'wishlists'         => WishlistResource::collection( $this -> whenLoaded( 'wishlists' ) ),
                'carts'             => CartResource::collection( $this -> whenLoaded( 'carts' ) ),
                'orders'            => OrderResource::collection( $this -> whenLoaded( 'orders' ) ),
                'stats'             =>
                [
//                    'wishlist_items'   => WishlistResource::collection( $this -> whenLoaded( 'wishlists' ) ) -> count(),
//                    'cart_items'       => CartResource::collection( $this -> whenLoaded( 'carts' ) ) -> count(),
//                    'total_orders'     => OrderResource::collection( $this -> whenLoaded( 'orders' ) ) -> count(),
                ]
            ])
        ];
    }
}
