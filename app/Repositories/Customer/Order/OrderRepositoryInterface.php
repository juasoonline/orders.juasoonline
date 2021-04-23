<?php

namespace App\Repositories\Customer\Order;

use App\Http\Requests\Customer\Order\OrderRequest;
use App\Models\Customer\Customer;
use App\Models\Customer\Order\Order;
use Illuminate\Http\JsonResponse;

interface OrderRepositoryInterface
{
    /**
     * @param Customer $customer
     * @return JsonResponse
     */
    public function index( Customer $customer ) : JsonResponse;

    /**
     * @param Customer $customer
     * @param OrderRequest $orderRequest
     * @return JsonResponse
     */
    public function store( Customer $customer, OrderRequest $orderRequest ) : JsonResponse;

    /**
     * @param Customer $customer
     * @param Order $order
     * @return JsonResponse
     */
    public function show( Customer $customer, Order $order ) : JsonResponse;

    /**
     * @param Customer $customer
     * @param OrderRequest $orderRequest
     * @param Order $order
     * @return JsonResponse
     */
    public function update( Customer $customer, OrderRequest $orderRequest, Order $order ) : JsonResponse;

    /**
     * @param Customer $customer
     * @param Order $order
     * @return JsonResponse
     */
    public function destroy( Customer $customer, Order $order ) : JsonResponse;
}
