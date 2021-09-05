<?php

namespace App\Http\Controllers\Juaso\Resource\DeliveryMethod;

use App\Http\Requests\Juaso\Resource\DeliveryMethod\DeliveryMethodRequest;
use App\Models\Juaso\Resource\DeliveryMethod\DeliveryMethod;
use App\Repositories\Juaso\Resource\DeliveryMethod\DeliveryMethodRepositoryInterface;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class DeliveryMethodController extends Controller
{
    private DeliveryMethodRepositoryInterface $theRepository;

    /**
     * DeliveryMethodController constructor.
     *
     * @param DeliveryMethodRepositoryInterface $deliveryMethodRepository
     */
    public function __construct( DeliveryMethodRepositoryInterface $deliveryMethodRepository )
    {
        $this -> theRepository = $deliveryMethodRepository;
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
     * @param DeliveryMethodRequest $deliveryMethodRequest
     * @return JsonResponse
     */
    public function store( DeliveryMethodRequest $deliveryMethodRequest ) : JsonResponse
    {
        return $this -> theRepository -> store( $deliveryMethodRequest );
    }

    /**
     * Display the specified resource.
     *
     * @param DeliveryMethod $deliveryMethod
     * @return JsonResponse
     */
    public function show( DeliveryMethod $deliveryMethod ) : JsonResponse
    {
        return $this -> theRepository -> show( $deliveryMethod );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DeliveryMethodRequest $deliveryMethodRequest
     * @param DeliveryMethod $deliveryMethod
     * @return JsonResponse
     */
    public function update( DeliveryMethodRequest $deliveryMethodRequest, DeliveryMethod $deliveryMethod ) : JsonResponse
    {
        return $this -> theRepository -> update( $deliveryMethodRequest, $deliveryMethod );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeliveryMethod $deliveryMethod
     * @return JsonResponse
     */
    public function destroy( DeliveryMethod $deliveryMethod ) : JsonResponse
    {
        return $this -> theRepository -> destroy( $deliveryMethod );
    }
}
