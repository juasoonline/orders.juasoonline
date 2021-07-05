<?php

namespace App\Repositories\Others\DeliveryFee;

use App\Http\Requests\Others\DeliveryFee\DeliveryFeeRequest;
use App\Http\Resources\Others\DeliveryFee\DeliveryFeeResource;
use App\Models\Others\DeliveryFee\DeliveryFee;
use App\Traits\apiResponseBuilder;
use App\Traits\Relatives;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class DeliveryFeeRepository implements DeliveryFeeRepositoryInterface
{
    use apiResponseBuilder, Relatives;

    /**
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        $PaymentMethods = DeliveryFee::query() -> when( $this -> loadRelationships(), function ( Builder $builder ) { return $builder -> with ( $this -> relationships ); } ) -> get();
        return $this -> successResponse( DeliveryFeeResource::collection( $PaymentMethods ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param DeliveryFeeRequest $deliveryFeeRequest
     * @return JsonResponse
     */
    public function store( DeliveryFeeRequest $deliveryFeeRequest ) : JsonResponse
    {
        //
    }

    /**
     * @param DeliveryFee $deliveryFee
     * @return JsonResponse
     */
    public function show( DeliveryFee $deliveryFee ) : JsonResponse
    {
        if ( $this -> loadRelationships() ) { $deliveryFee -> load( $this -> relationships ); }
        return $this -> successResponse( new DeliveryFeeResource( $deliveryFee ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param DeliveryFeeRequest $deliveryFeeRequest
     * @param DeliveryFee $deliveryFee
     * @return JsonResponse
     */
    public function update( DeliveryFeeRequest $deliveryFeeRequest, DeliveryFee $deliveryFee ) : JsonResponse
    {
        //
    }

    /**
     * @param DeliveryFee $deliveryFee
     * @return JsonResponse
     */
    public function destroy( DeliveryFee $deliveryFee ) : JsonResponse
    {
        $deliveryFee -> delete();
        return $this -> successResponse( null, 'Success', 'Customer deleted', Response::HTTP_NO_CONTENT );
    }
}
