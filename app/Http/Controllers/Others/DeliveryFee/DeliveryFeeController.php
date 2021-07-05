<?php

namespace App\Http\Controllers\Others\DeliveryFee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Others\DeliveryFee\DeliveryFeeRequest;
use App\Models\Others\DeliveryFee\DeliveryFee;
use App\Repositories\Others\DeliveryFee\DeliveryFeeRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeliveryFeeController extends Controller
{
    private DeliveryFeeRepositoryInterface $theRepository;

    /**
     * DeliveryFeeController constructor.
     *
     * @param DeliveryFeeRepositoryInterface $deliveryFeeRepository
     */
    public function __construct( DeliveryFeeRepositoryInterface $deliveryFeeRepository )
    {
        $this -> theRepository = $deliveryFeeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        return $this -> theRepository -> index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DeliveryFeeRequest $deliveryFeeRequest
     * @return JsonResponse
     */
    public function store( DeliveryFeeRequest $deliveryFeeRequest ) : JsonResponse
    {
        return $this -> theRepository -> store( $deliveryFeeRequest );
    }

    /**
     * Display the specified resource.
     *
     * @param DeliveryFee $deliveryFee
     * @return JsonResponse
     */
    public function show( DeliveryFee $deliveryFee ) : JsonResponse
    {
        return $this -> theRepository -> show( $deliveryFee );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DeliveryFeeRequest $deliveryFeeRequest
     * @param DeliveryFee $deliveryFee
     * @return JsonResponse
     */
    public function update( DeliveryFeeRequest $deliveryFeeRequest, DeliveryFee $deliveryFee ) : JsonResponse
    {
        return $this -> theRepository -> update( $deliveryFeeRequest, $deliveryFee );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeliveryFee $deliveryFee
     * @return JsonResponse
     */
    public function destroy( DeliveryFee $deliveryFee ) : JsonResponse
    {
        return $this -> theRepository -> destroy( $deliveryFee );
    }
}
