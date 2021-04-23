<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

/**
 * @return array|mixed
 */
function includeResources() : array
{
    return ( request() -> get( 'include' ) ) ? explode( ',', request() -> get( 'include' ) ) : [];
}

/**
 * Generate unique ID
 * @param int $length
 * @return string
 */
function generateProductID( int $length ) : string
{
    $number = '';
    do {
        for ( $i = $length; $i --; $i > 0 )
        {
            $number .= mt_rand(0,9);
        }
    }
    while ( !empty( DB::table( 'products' ) -> where( 'resource_id', $number ) -> first([ 'resource_id' ])) );

    return $number;
}

function checkResourceRelation( bool $is_related )
{
    abort_unless( $is_related, response() -> json([ 'status' => 'Error', 'code' => Response::HTTP_CONFLICT, 'message' => 'The resource you are trying to access does not belong to this category', 'data' => null ]));
}
