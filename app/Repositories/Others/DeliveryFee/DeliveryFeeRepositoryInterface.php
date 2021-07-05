<?php

namespace App\Repositories\Others\DeliveryFee;

use App\Http\Requests\Others\DeliveryFee\DeliveryFeeRequest;
use App\Models\Others\DeliveryFee\DeliveryFee;
use Illuminate\Http\JsonResponse;

interface DeliveryFeeRepositoryInterface
{
    /**
     * @return JsonResponse
     */
    public function index() : JsonResponse;

    /**
     * @param DeliveryFeeRequest $deliveryFeeRequest
     * @return JsonResponse
     */
    public function store( DeliveryFeeRequest $deliveryFeeRequest ) : JsonResponse;

    /**
     * @param DeliveryFee $deliveryFee
     * @return JsonResponse
     */
    public function show( DeliveryFee $deliveryFee ) : JsonResponse;

    /**
     * @param DeliveryFeeRequest $deliveryFeeRequest
     * @param DeliveryFee $deliveryFee
     * @return JsonResponse
     */
    public function update( DeliveryFeeRequest $deliveryFeeRequest, DeliveryFee $deliveryFee ) : JsonResponse;

    /**
     * @param DeliveryFee $deliveryFee
     * @return JsonResponse
     */
    public function destroy( DeliveryFee $deliveryFee ) : JsonResponse;
}
