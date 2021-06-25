<?php

namespace App\Repositories\Others\PaymentMethod;

use App\Http\Requests\Others\PaymentMethod\PaymentMethodRequest;
use App\Http\Resources\Others\PaymentMethod\PaymentMethodResource;
use App\Jobs\Others\PaymentMethod\CreatePaymentMethod;
use App\Jobs\Others\PaymentMethod\UpdatePaymentMethod;
use App\Models\Others\PaymentMethod\PaymentMethod;
use App\Traits\apiResponseBuilder;
use App\Traits\Relatives;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PaymentMethodRepository implements PaymentMethodRepositoryInterface
{
    use apiResponseBuilder, Relatives;

    /**
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        $PaymentMethods = PaymentMethod::query() -> when( $this -> loadRelationships(), function ( Builder $builder ) { return $builder -> with ( $this -> relationships ); } ) -> get();
        return $this -> successResponse( PaymentMethodResource::collection( $PaymentMethods ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param PaymentMethodRequest $paymentMethodRequest
     * @return JsonResponse
     */
    public function store( PaymentMethodRequest $paymentMethodRequest ) : JsonResponse
    {
        return $this -> successResponse( ( new CreatePaymentMethod( $paymentMethodRequest ) ) -> handle(), "Success", "Payment method created", Response::HTTP_CREATED );
    }

    /**
     * @param PaymentMethod $paymentMethod
     * @return JsonResponse
     */
    public function show( PaymentMethod $paymentMethod ) : JsonResponse
    {
        if ( $this -> loadRelationships() ) { $paymentMethod -> load( $this -> relationships ); }
        return $this -> successResponse( new PaymentMethodResource( $paymentMethod ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param PaymentMethodRequest $paymentMethodRequest
     * @param PaymentMethod $paymentMethod
     * @return JsonResponse
     */
    public function update( PaymentMethodRequest $paymentMethodRequest, PaymentMethod $paymentMethod ) : JsonResponse
    {
        return $this -> successResponse( ( new UpdatePaymentMethod( $paymentMethodRequest, $paymentMethod ) ) -> handle(), "Success", "Payment method updated", Response::HTTP_OK );
    }

    /**
     * @param PaymentMethod $paymentMethod
     * @return JsonResponse
     */
    public function destroy( PaymentMethod $paymentMethod ) : JsonResponse
    {
        $paymentMethod -> delete();
        return $this -> successResponse( null, 'Success', 'Payment method deleted', Response::HTTP_NO_CONTENT );
    }
}
