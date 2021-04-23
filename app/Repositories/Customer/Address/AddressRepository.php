<?php

namespace App\Repositories\Customer\Address;

use App\Http\Requests\Customer\Address\AddressRequest;
use App\Http\Resources\Customer\Address\AddressResource;
use App\Jobs\Customer\Address\CreateAddress;
use App\Jobs\Customer\Address\UpdateAddress;
use App\Models\Customer\Address\Address;
use App\Models\Customer\Customer;
use App\Traits\apiResponseBuilder;
use App\Traits\Relatives;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AddressRepository implements AddressRepositoryInterface
{
    use apiResponseBuilder, Relatives;

    /**
     * @param Customer $customer
     * @return JsonResponse
     */
    public function index( Customer $customer ) : JsonResponse
    {
        return $this -> successResponse( AddressResource::collection( $customer -> addresses() -> paginate() ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param Customer $customer
     * @param AddressRequest $addressRequest
     * @return JsonResponse
     */
    public function store( Customer $customer, AddressRequest $addressRequest ) : JsonResponse
    {
        return $this -> successResponse( ( new CreateAddress( $customer, $addressRequest ) ) -> handle(), "Success", "Address(es) created", Response::HTTP_CREATED );
    }

    /**
     * @param Customer $customer
     * @param Address $address
     * @return JsonResponse
     */
    public function show( Customer $customer, Address $address ) : JsonResponse
    {
        checkResourceRelation( $customer -> addresses() -> where( 'addresses.id', $address -> id ) -> count());
        if ( $this -> loadRelationships() ) { $address -> load( $this -> relationships ); }
        return $this -> successResponse( new AddressResource( $address ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param Customer $customer
     * @param AddressRequest $addressRequest
     * @param Address $address
     * @return JsonResponse
     */
    public function update( Customer $customer, AddressRequest $addressRequest, Address $address ) : JsonResponse
    {
        checkResourceRelation( $customer -> addresses() -> where( 'addresses.id', $address -> id ) -> count());
        return $this -> successResponse( ( new UpdateAddress( $addressRequest, $address ) ) -> handle(), 'Success', 'Address updated', Response::HTTP_OK );
    }

    /**
     * @param Customer $customer
     * @param Address $address
     * @return JsonResponse
     */
    public function destroy( Customer $customer, Address $address ) : JsonResponse
    {
        checkResourceRelation( $customer -> addresses() -> where( 'addresses.id', $address -> id ) -> count());
        $address -> delete();
        return $this -> successResponse( null, 'Success', 'Address deleted', Response::HTTP_NO_CONTENT );
    }
}
