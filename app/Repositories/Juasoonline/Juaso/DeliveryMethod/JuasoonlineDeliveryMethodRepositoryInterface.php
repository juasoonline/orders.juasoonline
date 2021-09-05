<?php

namespace App\Repositories\Juasoonline\Juaso\DeliveryMethod;

use App\Models\Juaso\Resource\DeliveryMethod\DeliveryMethod;
use Illuminate\Http\JsonResponse;

interface JuasoonlineDeliveryMethodRepositoryInterface
{
    /**
     * @return JsonResponse
     */
    public function index() : JsonResponse;

    /**
     * @param DeliveryMethod $deliveryMethod
     * @return JsonResponse
     */
    public function show( DeliveryMethod $deliveryMethod ) : JsonResponse;
}
