<?php

namespace App\Repositories\Juasoonline\Resource\Customer\Order;

use App\Http\Requests\Juasoonline\Resource\Customer\Order\OrderRequest;
use App\Models\Juasoonline\Resource\Customer\Order\Order;
use Illuminate\Http\JsonResponse;

interface OrderRepositoryInterface
{
    /**
     * @param $customer
     * @return JsonResponse
     */
    public function index( $customer ) : JsonResponse;

    /**
     * @param OrderRequest $orderRequest
     * @return JsonResponse
     */
    public function store( OrderRequest $orderRequest ) : JsonResponse;

    /**
     * @param $customer
     * @param Order $order
     * @return JsonResponse
     */
    public function show( $customer, Order $order ) : JsonResponse;
}
