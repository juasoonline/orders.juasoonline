<?php

namespace App\Http\Controllers\Juasoonline\Resource\Customer\Order;

use App\Http\Requests\Juasoonline\Resource\Customer\Order\OrderRequest;
use App\Models\Juasoonline\Resource\Customer\Order\Order;

use App\Http\Controllers\Controller;
use App\Repositories\Juasoonline\Resource\Customer\Order\OrderRepositoryInterface;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    private OrderRepositoryInterface $theRepository;

    /**
     * CustomerController constructor.
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
     * @param $customer
     * @return JsonResponse
     */
    public function index( $customer ) : JsonResponse
    {
        return $this -> theRepository -> index( $customer );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderRequest $orderRequest
     * @return JsonResponse
     */
    public function store( OrderRequest $orderRequest ) : JsonResponse
    {
        return $this -> theRepository -> store( $orderRequest );
    }

    /**
     * Display the specified resource.
     *
     * @param $customer
     * @param Order $order
     * @return JsonResponse
     */
    public function show( $customer, Order $order ) : JsonResponse
    {
        return $this -> theRepository -> show( $customer, $order );
    }
}
