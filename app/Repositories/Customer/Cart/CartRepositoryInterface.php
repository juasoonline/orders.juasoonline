<?php

namespace App\Repositories\Customer\Cart;

use App\Http\Requests\Customer\Cart\CartRequest;
use App\Models\Customer\Cart\Cart;
use App\Models\Customer\Customer;
use Illuminate\Http\JsonResponse;

interface CartRepositoryInterface
{
    /**
     * @param Customer $customer
     * @return JsonResponse
     */
    public function index( Customer $customer ) : JsonResponse;

    /**
     * @param Customer $customer
     * @param CartRequest $cartRequest
     * @return JsonResponse
     */
    public function store( Customer $customer, CartRequest $cartRequest ) : JsonResponse;
//
//    /**
//     * @param Customer $customer
//     * @param Cart $cart
//     * @return JsonResponse
//     */
//    public function show( Customer $customer, Cart $cart ) : JsonResponse;

    /**
     * @param Customer $customer
     * @param CartRequest $cartRequest
     * @param Cart $cart
     * @return JsonResponse
     */
    public function update( Customer $customer, CartRequest $cartRequest, Cart $cart ) : JsonResponse;

    /**
     * @param Customer $customer
     * @param Cart $cart
     * @return JsonResponse
     */
    public function destroy( Customer $customer, Cart $cart ) : JsonResponse;
}
