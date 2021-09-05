<?php

namespace App\Http\Controllers\Juasoonline\Juaso\DeliveryMethod;

use App\Repositories\Juasoonline\Juaso\DeliveryMethod\JuasoonlineDeliveryMethodRepositoryInterface;
use App\Models\Juaso\Resource\DeliveryMethod\DeliveryMethod;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class JuasoonlineDeliveryMethodController extends Controller
{
    private JuasoonlineDeliveryMethodRepositoryInterface $theRepository;

    /**
     * JuasoonlineDeliveryMethodController constructor.
     * @param JuasoonlineDeliveryMethodRepositoryInterface $juasoonlineRepository
     */
    public function __construct( JuasoonlineDeliveryMethodRepositoryInterface $juasoonlineRepository )
    {
        $this -> theRepository = $juasoonlineRepository;
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
     * Display the specified resource.
     *
     * @param DeliveryMethod $deliveryMethod
     * @return JsonResponse
     */
    public function show( DeliveryMethod $deliveryMethod ) : JsonResponse
    {
        return $this -> theRepository -> show( $deliveryMethod );
    }
}
