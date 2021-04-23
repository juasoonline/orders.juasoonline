<?php

namespace App\Http\Controllers\Customer\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Order\OrderRequest;
use App\Models\Customer\Customer;
use App\Models\Customer\Order\Order;
use App\Repositories\Customer\Order\OrderRepositoryInterface;
use App\Traits\apiResponseBuilder;
use App\Traits\Relatives;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use apiResponseBuilder, Relatives;
    private OrderRepositoryInterface $theRepository;

    /**
     * OrderController constructor.
     *
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct( OrderRepositoryInterface $orderRepository )
    {
        $this -> theRepository = $orderRepository;
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
     * @param OrderRequest $orderRequest
     * @return JsonResponse
     */
    public function store( Customer $customer, OrderRequest $orderRequest ) : JsonResponse
    {
        return $this -> theRepository -> store( $customer, $orderRequest );
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @param Order $order
     * @return JsonResponse
     */
    public function show( Customer $customer, Order $order ) : JsonResponse
    {
        return $this -> theRepository -> show( $customer, $order );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Customer $customer
     * @param OrderRequest $orderRequest
     * @param Order $order
     * @return JsonResponse
     */
    public function update( Customer $customer, OrderRequest $orderRequest, Order $order ) : JsonResponse
    {
        return $this -> theRepository -> update( $customer, $orderRequest, $order );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @param Order $order
     * @return JsonResponse
     */
    public function destroy( Customer $customer, Order $order ) : JsonResponse
    {
        return $this -> theRepository -> destroy( $customer, $order );
    }
}
