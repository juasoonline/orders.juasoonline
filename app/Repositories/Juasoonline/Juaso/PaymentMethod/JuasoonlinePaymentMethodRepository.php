<?php

namespace App\Repositories\Juasoonline\Juaso\PaymentMethod;

use App\Http\Resources\Juaso\Resource\PaymentMethod\PaymentMethodResource;
use App\Models\Juaso\Resource\PaymentMethod\PaymentMethod;

use App\Traits\apiResponseBuilder;
use App\Traits\Relatives;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JuasoonlinePaymentMethodRepository implements JuasoonlinePaymentMethodRepositoryInterface
{
    use apiResponseBuilder, Relatives;

    /**
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        $PaymentMethods = PaymentMethod::query() -> when( $this -> loadRelationships(), function ( Builder $builder ) { return $builder -> with ( $this -> relationships ); } ) -> paginate( 20 );
        return $this -> successResponse( PaymentMethodResource::collection( $PaymentMethods ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param PaymentMethod $paymentMethod
     * @return JsonResponse
     */
    public function show( PaymentMethod  $paymentMethod ) : JsonResponse
    {
        return $this -> successResponse( new PaymentMethodResource( $paymentMethod ), "Success", null, Response::HTTP_OK );
    }
}
