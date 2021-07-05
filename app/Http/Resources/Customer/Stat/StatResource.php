<?php

namespace App\Http\Resources\Customer\Stat;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatResource extends JsonResource
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
            'id'                            => $this -> resource -> id,
            'type'                          => 'Stats',

            'attributes' =>
            [
                'wishlist_items'            => count( $this -> resource -> wishlists ),
                'cart_items'                => count( $this -> resource -> carts ),
                'total_orders'              => count( $this -> resource -> orders ),
            ]
        ];
    }
}
