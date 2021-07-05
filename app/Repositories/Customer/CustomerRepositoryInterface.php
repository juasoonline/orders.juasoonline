<?php

namespace App\Repositories\Customer;

use App\Http\Requests\Customer\CustomerRequest;
use App\Models\Customer\Customer;
use Illuminate\Http\JsonResponse;

interface CustomerRepositoryInterface
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse;

    /**
     * @param CustomerRequest $customerRequest
     * @return JsonResponse|mixed
     */
    public function store( CustomerRequest $customerRequest ): JsonResponse;

    /**
     * @param Customer $customer
     * @return JsonResponse|mixed
     */
    public function show( Customer $customer ): JsonResponse;

    /**
     * @param CustomerRequest $customerRequest
     * @param Customer $customer
     * @return JsonResponse
     */
    public function update( CustomerRequest $customerRequest, Customer $customer ): JsonResponse;

    /**
     * @param Customer $customer
     * @return JsonResponse
     */
    public function destroy( Customer $customer ): JsonResponse;

    /**
     * @param Customer $customer
     * @return JsonResponse
     */
    public function getStats( Customer $customer ) : JsonResponse;
}
