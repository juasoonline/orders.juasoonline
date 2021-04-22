<?php

namespace App\Repositories\Customer\Order;

use App\Http\Requests\Customer\Order\OrderRequest;
use App\Http\Resources\Customer\Order\OrderResource;
use App\Jobs\Customer\Order\CreateOrder;
use App\Jobs\Customer\Order\UpdateOrder;
use App\Models\Customer\Customer;
use App\Models\Customer\Order\Order;
use App\Traits\apiResponseBuilder;
use App\Traits\Relatives;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class OrderRepository implements OrderRepositoryInterface
{
    use apiResponseBuilder, Relatives;

    /**
     * @param Customer $customer
     * @return JsonResponse
     */
    public function index( Customer $customer ) : JsonResponse
    {
        return $this -> successResponse( OrderResource::collection( $customer -> orders() -> paginate() ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param Customer $customer
     * @param OrderRequest $orderRequest
     * @return JsonResponse
     */
    public function store( Customer $customer, OrderRequest $orderRequest ) : JsonResponse
    {
        return $this -> successResponse( ( new CreateOrder( $customer, $orderRequest ) ) -> handle(), "Success", "Order(s) created", Response::HTTP_CREATED );
    }

    /**
     * @param Customer $customer
     * @param Order $order
     * @return JsonResponse
     */
    public function show( Customer $customer, Order $order ) : JsonResponse
    {
        checkResourceRelation( $customer -> orders() -> where( 'orders.id', $order -> id ) -> count());
        if ( $this -> loadRelationships() ) { $order -> load( $this -> relationships ); }
        return $this -> successResponse( new OrderResource( $order ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param Customer $customer
     * @param OrderRequest $orderRequest
     * @param Order $order
     * @return JsonResponse
     */
    public function update( Customer $customer, OrderRequest $orderRequest, Order $order ) : JsonResponse
    {
        checkResourceRelation( $customer -> orders() -> where( 'orders.id', $order -> id ) -> count());
        return $this -> successResponse( ( new UpdateOrder( $orderRequest, $order ) ) -> handle(), 'Success', 'Order updated', Response::HTTP_OK );
    }

    /**
     * @param Customer $customer
     * @param Order $order
     * @return JsonResponse
     */
    public function destroy( Customer $customer, Order $order ) : JsonResponse
    {
        checkResourceRelation( $customer -> orders() -> where( 'orders.id', $order -> id ) -> count());
        $order -> delete();
        return $this -> successResponse( null, 'Success', 'Order deleted', Response::HTTP_NO_CONTENT );
    }
}
