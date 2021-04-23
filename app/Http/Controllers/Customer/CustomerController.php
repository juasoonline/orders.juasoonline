<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerRequest;
use App\Models\Customer\Customer;
use App\Repositories\Customer\CustomerRepositoryInterface;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    private CustomerRepositoryInterface $theRepository;

    /**
     * CustomerController constructor.
     *
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct( CustomerRepositoryInterface $customerRepository )
    {
        $this -> theRepository = $customerRepository;
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
     * @param CustomerRequest $customerRequest
     * @return JsonResponse|mixed
     */
    public function store( CustomerRequest $customerRequest ) : JsonResponse
    {
        return $this -> theRepository -> store( $customerRequest );
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @return JsonResponse|mixed
     */
    public function show( Customer $customer ) : JsonResponse
    {
        return $this -> theRepository -> show( $customer );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CustomerRequest $customerRequest
     * @param Customer $customer
     * @return JsonResponse
     */
    public function update( CustomerRequest $customerRequest, Customer $customer ) : JsonResponse
    {
        return $this -> theRepository -> update( $customerRequest, $customer );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return JsonResponse
     */
    public function destroy( Customer $customer ) : JsonResponse
    {
        return $this -> theRepository -> destroy( $customer );
    }
}
