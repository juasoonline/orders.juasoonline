<?php

namespace App\Repositories\Juaso\Resource\DeliveryMethod;

use App\Http\Requests\Juaso\Resource\DeliveryMethod\DeliveryMethodRequest;
use App\Http\Resources\Juaso\Resource\DeliveryMethod\DeliveryMethodResource;
use App\Jobs\Juaso\Resource\DeliveryMethod\CreateDeliveryMethod;
use App\Jobs\Juaso\Resource\DeliveryMethod\UpdateDeliveryMethod;
use App\Models\Juaso\Resource\DeliveryMethod\DeliveryMethod;

use App\Traits\apiResponseBuilder;
use App\Traits\Relatives;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class DeliveryMethodRepository implements DeliveryMethodRepositoryInterface
{
    use apiResponseBuilder, Relatives;

    /**
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        $PaymentMethods = DeliveryMethod::query() -> when( $this -> loadRelationships(), function ( Builder $builder ) { return $builder -> with ( $this -> relationships ); } ) -> get();
        return $this -> successResponse( DeliveryMethodResource::collection( $PaymentMethods ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param DeliveryMethodRequest $deliveryMethodRequest
     * @return JsonResponse
     */
    public function store( DeliveryMethodRequest $deliveryMethodRequest ) : JsonResponse
    {
        return $this -> successResponse( ( new CreateDeliveryMethod( $deliveryMethodRequest ) ) -> handle(), "Success", "Delivery method created", Response::HTTP_CREATED );
    }

    /**
     * @param DeliveryMethod $deliveryMethod
     * @return JsonResponse
     */
    public function show( DeliveryMethod $deliveryMethod ) : JsonResponse
    {
        if ( $this -> loadRelationships() ) { $deliveryMethod -> load( $this -> relationships ); }
        return $this -> successResponse( new DeliveryMethodResource( $deliveryMethod ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param DeliveryMethodRequest $deliveryMethodRequest
     * @param DeliveryMethod $deliveryMethod
     * @return JsonResponse
     */
    public function update( DeliveryMethodRequest $deliveryMethodRequest, DeliveryMethod $deliveryMethod ) : JsonResponse
    {
        return $this -> successResponse( ( new UpdateDeliveryMethod( $deliveryMethodRequest, $deliveryMethod ) ) -> handle(), "Success", "Delivery method updated", Response::HTTP_OK );
    }

    /**
     * @param DeliveryMethod $deliveryMethod
     * @return JsonResponse|mixed
     */
    public function destroy( DeliveryMethod $deliveryMethod ) : JsonResponse
    {
        try
        {
            $deliveryMethod -> delete();
            return $this -> successResponse( null, 'Success', 'Delivery method deleted', Response::HTTP_NO_CONTENT );
        }

        catch ( Exception $exception )
        {
            report( $exception );
            return abort( $this -> errorResponse( null, 'Error', 'Something went wrong, please try again later', Response::HTTP_SERVICE_UNAVAILABLE ) );
        }
    }
}
