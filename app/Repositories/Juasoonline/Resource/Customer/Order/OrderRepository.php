<?php

namespace App\Repositories\Juasoonline\Resource\Customer\Order;

use App\Http\Requests\Juasoonline\Resource\Customer\Order\OrderRequest;
use App\Http\Resources\Juasoonline\Resource\Customer\Order\OrderResource;
use App\Jobs\Juasoonline\Resource\Customer\Order\CreateOrder;
use App\Models\Juasoonline\Resource\Customer\Order\Order;

use App\Traits\apiResponseBuilder;
use App\Traits\Relatives;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class OrderRepository implements OrderRepositoryInterface
{
    use apiResponseBuilder, Relatives;
    /**
     * @param $customer
     * @return JsonResponse
     */
    public function index( $customer ) : JsonResponse
    {
        $customers = Order::where( 'customer_id', "=", $customer ) -> get();
        if ( $this -> loadRelationships() ) { $customers -> load( $this -> relationships ); }
        return $this -> successResponse( OrderResource::collection( $customers ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param OrderRequest $orderRequest
     * @return JsonResponse
     */
    public function store( OrderRequest $orderRequest ) : JsonResponse
    {
        return $this -> successResponse( ( new CreateOrder( $orderRequest ) ) -> handle(), "Success", "Order created", Response::HTTP_CREATED );
    }

    /**
     * @param $customer
     * @param Order $order
     * @return JsonResponse
     */
    public function show( $customer, Order $order ) : JsonResponse
    {
        $customers = Order::where( 'customer_id', "=", $customer ) -> where( 'id', "=", $order -> id ) -> get();
        if ( $this -> loadRelationships() ) { $customers -> load( $this -> relationships ); }
        return $this -> successResponse( OrderResource::collection( $customers ), "Success", null, Response::HTTP_OK );
    }
}
