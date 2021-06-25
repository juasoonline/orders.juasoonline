<?php

namespace App\Http\Controllers\Others\PaymentMethod;

use App\Http\Controllers\Controller;
use App\Http\Requests\Others\PaymentMethod\PaymentMethodRequest;
use App\Models\Others\PaymentMethod\PaymentMethod;
use App\Repositories\Others\PaymentMethod\PaymentMethodRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentMethodController extends Controller
{
    private PaymentMethodRepositoryInterface $theRepository;

    /**
     * CustomerController constructor.
     *
     * @param PaymentMethodRepositoryInterface $paymentMethodRepository
     */
    public function __construct( PaymentMethodRepositoryInterface $paymentMethodRepository )
    {
        $this -> theRepository = $paymentMethodRepository;
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
     * @param PaymentMethodRequest $paymentMethodRequest
     * @return JsonResponse
     */
    public function store( PaymentMethodRequest $paymentMethodRequest ) : JsonResponse
    {
        return $this -> theRepository -> store( $paymentMethodRequest );
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentMethod $paymentMethod
     * @return JsonResponse
     */
    public function show( PaymentMethod $paymentMethod ) : JsonResponse
    {
        return $this -> theRepository -> show( $paymentMethod );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PaymentMethodRequest $paymentMethodRequest
     * @param PaymentMethod $paymentMethod
     * @return JsonResponse
     */
    public function update( PaymentMethodRequest $paymentMethodRequest, PaymentMethod $paymentMethod ) : JsonResponse
    {
        return $this -> theRepository -> update( $paymentMethodRequest, $paymentMethod );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PaymentMethod $paymentMethod
     * @return JsonResponse
     */
    public function destroy( PaymentMethod $paymentMethod ) : JsonResponse
    {
        return $this -> theRepository -> destroy( $paymentMethod );
    }
}
