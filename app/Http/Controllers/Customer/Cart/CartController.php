<?php

namespace App\Http\Controllers\Customer\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Cart\CartRequest;
use App\Models\Customer\Cart\Cart;
use App\Models\Customer\Customer;
use App\Repositories\Customer\Cart\CartRepositoryInterface;
use App\Traits\apiResponseBuilder;
use App\Traits\Relatives;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use apiResponseBuilder, Relatives;
    private CartRepositoryInterface $theRepository;

    /**
     * CartController constructor.
     *
     * @param CartRepositoryInterface $cartRepository
     */
    public function __construct( CartRepositoryInterface $cartRepository )
    {
        $this -> theRepository = $cartRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Customer $customer
     * @return JsonResponse
     */
    public function index( Customer $customer ) : JsonResponse
    {
        return $this -> theRepository -> index( $customer );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Customer $customer
     * @param CartRequest $cartRequest
     * @return JsonResponse
     */
    public function store( Customer $customer, CartRequest $cartRequest ) : JsonResponse
    {
        return $this -> theRepository -> store( $customer, $cartRequest );
    }

//    /**
//     * Display the specified resource.
//     *
//     * @param Customer $customer
//     * @param Cart $cart
//     * @return JsonResponse
//     */
//    public function show( Customer $customer, Cart $cart ) : JsonResponse
//    {
//        return $this -> theRepository -> show( $customer, $cart );
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param Customer $customer
     * @param CartRequest $cartRequest
     * @param Cart $cart
     * @return JsonResponse
     */
    public function update( Customer $customer, CartRequest $cartRequest, Cart $cart ) : JsonResponse
    {
        return $this -> theRepository -> update( $customer, $cartRequest, $cart );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @param Cart $cart
     * @return JsonResponse
     */
    public function destroy( Customer $customer, Cart $cart ) : JsonResponse
    {
        return $this -> theRepository -> destroy( $customer, $cart );
    }
}
