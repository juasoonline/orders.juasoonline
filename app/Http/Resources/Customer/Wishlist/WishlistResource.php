<?php

namespace App\Http\Resources\Customer\Wishlist;

use App\Http\Resources\Customer\CustomerResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method relationLoaded( string $string )
 */
class WishlistResource extends JsonResource
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
            'type'                  => 'Wishlist',

            'attributes' =>
            [
                'resource_id'       => $this -> resource_id,

                'customer_resource' => $this -> customer_id,
                'product_resource'  => $this -> product_id,

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
