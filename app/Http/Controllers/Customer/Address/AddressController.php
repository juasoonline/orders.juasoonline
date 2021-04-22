<?php

namespace App\Http\Controllers\Customer\Address;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Address\AddressRequest;
use App\Models\Customer\Address\Address;
use App\Models\Customer\Customer;
use App\Repositories\Customer\Address\AddressRepositoryInterface;
use App\Traits\apiResponseBuilder;
use App\Traits\Relatives;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    use apiResponseBuilder, Relatives;
    private AddressRepositoryInterface $theRepository;

    /**
     * AddressController constructor.
     *
     * @param AddressRepositoryInterface $addressRepository
     */
    public function __construct( AddressRepositoryInterface $addressRepository )
    {
        $this -> theRepository = $addressRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Customer $customer
     * @return JsonResponse
     */
    public function index( Customer $customer ) : JsonResponse
    {
        return $this -> theRepository -> index( $customer );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Customer $customer
     * @param AddressRequest $addressRequest
     * @return JsonResponse
     */
    public function store( Customer $customer, AddressRequest $addressRequest ) : JsonResponse
    {
        return $this -> theRepository -> store( $customer, $addressRequest );
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @param Address $address
     * @return JsonResponse
     */
    public function show( Customer $customer, Address $address ) : JsonResponse
    {
        return $this -> theRepository -> show( $customer, $address );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Customer $customer
     * @param AddressRequest $addressRequest
     * @param Address $address
     * @return JsonResponse
     */
    public function update( Customer $customer, AddressRequest $addressRequest, Address $address ) : JsonResponse
    {
        return $this -> theRepository -> update( $customer, $addressRequest, $address );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @param Address $address
     * @return JsonResponse
     */
    public function destroy( Customer $customer, Address $address ) : JsonResponse
    {
        return $this -> theRepository -> destroy( $customer, $address );
    }
}
