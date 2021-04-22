<?php

namespace App\Repositories\Customer\Cart;

use App\Http\Requests\Customer\Cart\CartRequest;
use App\Http\Resources\Customer\Cart\CartResource;
use App\Jobs\Customer\Cart\CreateCart;
use App\Jobs\Customer\Cart\UpdateCart;
use App\Models\Customer\Cart\Cart;
use App\Models\Customer\Customer;
use App\Traits\apiResponseBuilder;
use App\Traits\Relatives;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CartRepository implements CartRepositoryInterface
{
    use apiResponseBuilder, Relatives;

    /**
     * @param Customer $customer
     * @return JsonResponse
     */
    public function index( Customer $customer ) : JsonResponse
    {
        return $this -> successResponse( CartResource::collection( $customer -> carts() -> paginate() ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param Customer $customer
     * @param CartRequest $cartRequest
     * @return JsonResponse
     */
    public function store( Customer $customer, CartRequest $cartRequest ) : JsonResponse
    {
        return $this -> successResponse( ( new CreateCart( $customer, $cartRequest ) ) -> handle(), "Success", "Product(s) added to cart", Response::HTTP_CREATED );
    }

    /**
     * @param Customer $customer
     * @param Cart $cart
     * @return JsonResponse
     */
    public function show( Customer $customer, Cart $cart ) : JsonResponse
    {
        checkResourceRelation( $customer -> carts() -> where( 'carts.id', $cart -> id ) -> count());
        if ( $this -> loadRelationships() ) { $cart -> load( $this -> relationships ); }
        return $this -> successResponse( new CartResource( $cart ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param Customer $customer
     * @param CartRequest $cartRequest
     * @param Cart $cart
     * @return JsonResponse
     */
    public function update( Customer $customer, CartRequest $cartRequest, Cart $cart ) : JsonResponse
    {
        checkResourceRelation( $customer -> carts() -> where( 'carts.id', $cart -> id ) -> count());
        return $this -> successResponse( ( new UpdateCart( $cartRequest, $cart ) ) -> handle(), 'Success', 'Cart item(s) updated', Response::HTTP_OK );
    }

    /**
     * @param Customer $customer
     * @param Cart $cart
     * @return JsonResponse
     */
    public function destroy( Customer $customer, Cart $cart ) : JsonResponse
    {
        checkResourceRelation( $customer -> carts() -> where( 'carts.id', $cart -> id ) -> count());
        $cart -> delete();
        return $this -> successResponse( null, 'Success', 'Cart item(s) deleted', Response::HTTP_NO_CONTENT );
    }
}
