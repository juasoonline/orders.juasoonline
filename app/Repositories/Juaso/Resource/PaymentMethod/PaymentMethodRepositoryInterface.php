<?php

namespace App\Repositories\Juaso\Resource\PaymentMethod;

use App\Http\Requests\Juaso\Resource\PaymentMethod\PaymentMethodRequest;
use App\Models\Juaso\Resource\PaymentMethod\PaymentMethod;

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
