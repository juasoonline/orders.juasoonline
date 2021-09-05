<?php

namespace App\Repositories\Juasoonline\Juaso\PaymentMethod;

use App\Models\Juaso\Resource\PaymentMethod\PaymentMethod;
use Illuminate\Http\JsonResponse;

interface JuasoonlinePaymentMethodRepositoryInterface
{
    /**
     * @return JsonResponse
     */
    public function index() : JsonResponse;

    /**
     * @param PaymentMethod $paymentMethod
     * @return JsonResponse
     */
    public function show( PaymentMethod $paymentMethod ) : JsonResponse;
}
