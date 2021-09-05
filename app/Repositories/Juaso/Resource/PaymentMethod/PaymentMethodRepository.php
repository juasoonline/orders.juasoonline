<?php

namespace App\Repositories\Juaso\Resource\PaymentMethod;

use App\Http\Requests\Juaso\Resource\PaymentMethod\PaymentMethodRequest;
use App\Http\Resources\Juaso\Resource\PaymentMethod\PaymentMethodResource;
use App\Jobs\Juaso\Resource\PaymentMethod\CreatePaymentMethod;
use App\Jobs\Juaso\Resource\PaymentMethod\UpdatePaymentMethod;
use App\Models\Juaso\Resource\PaymentMethod\PaymentMethod;

use App\Traits\apiResponseBuilder;
use App\Traits\Relatives;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Exception;

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
     * @return JsonResponse|mixed
     */
    public function destroy( PaymentMethod $paymentMethod ) : JsonResponse
    {
        try
        {
            $paymentMethod -> delete();
            return $this -> successResponse( null, 'Success', 'Payment method deleted', Response::HTTP_NO_CONTENT );
        }

        catch ( Exception $exception )
        {
            report( $exception );
            return abort( $this -> errorResponse( null, 'Error', 'Something went wrong, please try again later', Response::HTTP_SERVICE_UNAVAILABLE ) );
        }
    }
}
