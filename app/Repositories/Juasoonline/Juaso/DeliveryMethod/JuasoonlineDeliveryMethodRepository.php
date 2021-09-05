<?php

namespace App\Repositories\Juasoonline\Juaso\DeliveryMethod;

use App\Http\Resources\Juaso\Resource\DeliveryMethod\DeliveryMethodResource;
use App\Models\Juaso\Resource\DeliveryMethod\DeliveryMethod;

use App\Traits\apiResponseBuilder;
use App\Traits\Relatives;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JuasoonlineDeliveryMethodRepository implements JuasoonlineDeliveryMethodRepositoryInterface
{
    use apiResponseBuilder, Relatives;

    /**
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        $DeliveryMethod = DeliveryMethod::query() -> when( $this -> loadRelationships(), function ( Builder $builder ) { return $builder -> with ( $this -> relationships ); } ) -> get();
        return $this -> successResponse( DeliveryMethodResource::collection( $DeliveryMethod ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param DeliveryMethod $deliveryMethod
     * @return JsonResponse
     */
    public function show( DeliveryMethod $deliveryMethod ) : JsonResponse
    {
        return $this -> successResponse( new DeliveryMethodResource( $deliveryMethod ), "Success", null, Response::HTTP_OK );
    }
}
