<?php

namespace App\Repositories\Juaso\Resource\DeliveryMethod;

use App\Http\Requests\Juaso\Resource\DeliveryMethod\DeliveryMethodRequest;
use App\Models\Juaso\Resource\DeliveryMethod\DeliveryMethod;
use Illuminate\Http\JsonResponse;

interface DeliveryMethodRepositoryInterface
{
    /**
     * @return JsonResponse
     */
    public function index() : JsonResponse;

    /**
     * @param DeliveryMethodRequest $deliveryMethodRequest
     * @return JsonResponse
     */
    public function store( DeliveryMethodRequest $deliveryMethodRequest ) : JsonResponse;

    /**
     * @param DeliveryMethod $deliveryMethod
     * @return JsonResponse
     */
    public function show( DeliveryMethod $deliveryMethod ) : JsonResponse;

    /**
     * @param DeliveryMethodRequest $deliveryMethodRequest
     * @param DeliveryMethod $deliveryMethod
     * @return JsonResponse
     */
    public function update( DeliveryMethodRequest $deliveryMethodRequest, DeliveryMethod $deliveryMethod ) : JsonResponse;

    /**
     * @param DeliveryMethod $deliveryMethod
     * @return JsonResponse
     */
    public function destroy( DeliveryMethod $deliveryMethod ) : JsonResponse;
}
