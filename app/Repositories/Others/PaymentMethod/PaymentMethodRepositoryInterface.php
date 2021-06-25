<?php

namespace App\Repositories\Others\PaymentMethod;

use App\Http\Requests\Others\PaymentMethod\PaymentMethodRequest;
use App\Models\Others\PaymentMethod\PaymentMethod;
use Illuminate\Http\JsonResponse;

interface PaymentMethodRepositoryInterface
{
    /**
     * @return JsonResponse
     */
    public function index() : JsonResponse;

    /**
     * @param PaymentMethodRequest $paymentMethodRequest
     * @return JsonResponse
     */
    public function store( PaymentMethodRequest $paymentMethodRequest ) : JsonResponse;

    /**
     * @param PaymentMethod $paymentMethod
     * @return JsonResponse
     */
    public function show( PaymentMethod $paymentMethod ) : JsonResponse;

    /**
     * @param PaymentMethodRequest $paymentMethodRequest
     * @param PaymentMethod $paymentMethod
     * @return JsonResponse
     */
    public function update( PaymentMethodRequest $paymentMethodRequest, PaymentMethod $paymentMethod ) : JsonResponse;

    /**
     * @param PaymentMethod $paymentMethod
     * @return JsonResponse
     */
    public function destroy( PaymentMethod $paymentMethod ) : JsonResponse;
}
