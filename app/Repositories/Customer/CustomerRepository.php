<?php

namespace App\Repositories\Customer;

use App\Http\Requests\Customer\CustomerRequest;
use App\Http\Resources\Customer\CustomerResource;
use App\Http\Resources\Customer\Stat\StatResource;
use App\Jobs\Customer\CreateCustomer;
use App\Jobs\Customer\UpdateCustomer;
use App\Models\Customer\Customer;
use App\Traits\apiResponseBuilder;
use App\Traits\Relatives;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CustomerRepository implements CustomerRepositoryInterface
{
    use apiResponseBuilder, Relatives;

    /**
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        $Customers = Customer::query() -> when( $this -> loadRelationships(), function ( Builder $builder ) { return $builder -> with ( $this -> relationships ); } ) -> paginate( 20 );
        return $this -> successResponse( CustomerResource::collection( $Customers ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param CustomerRequest $customerRequest
     * @return JsonResponse|mixed
     */
    public function store( CustomerRequest $customerRequest ) : JsonResponse
    {
        return $this -> successResponse( ( new CreateCustomer( $customerRequest ) ) -> handle(), "Success", "Customer created", Response::HTTP_CREATED );
    }

    /**
     * @param Customer $customer
     * @return JsonResponse|mixed
     */
    public function show( Customer $customer ) : JsonResponse
    {
        if ( $this -> loadRelationships() ) { $customer -> load( $this -> relationships ); }
        return $this -> successResponse( new CustomerResource( $customer ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param CustomerRequest $customerRequest
     * @param Customer $customer
     * @return JsonResponse
     */
    public function update( CustomerRequest $customerRequest, Customer $customer ) : JsonResponse
    {
        if ( $this -> loadRelationships() ) { $customer -> load( $this -> relationships ); }
        return $this -> successResponse( ( new UpdateCustomer( $customerRequest, $customer ) ) -> handle(), 'Success', 'Customer updated', Response::HTTP_OK );
    }

    /**
     * @param Customer $customer
     * @return JsonResponse
     */
    public function destroy( Customer $customer ) : JsonResponse
    {
        $customer -> delete();
        return $this -> successResponse( null, 'Success', 'Customer deleted', Response::HTTP_NO_CONTENT );
    }

    /**
     * @param Customer $customer
     * @return JsonResponse
     */
    public function getStats( Customer $customer ) : JsonResponse
    {
        return $this -> successResponse( new StatResource( $customer ), "Success", null, Response::HTTP_OK );
    }
}
