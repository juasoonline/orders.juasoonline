<?php

namespace App\Http\Controllers\Juaso\Resource\Shipper\Shipper;

use App\Repositories\Juaso\Resource\Shipper\Shipper\ShipperRepositoryInterface;
use App\Http\Requests\Juaso\Resource\Shipper\Shipper\ShipperRequest;
use App\Models\Juaso\Resource\Shipper\Shipper\Shipper;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ShipperController extends Controller
{
    private ShipperRepositoryInterface $theRepository;

    /**
     * ShipperController constructor.
     *
     * @param ShipperRepositoryInterface $shipperRepository
     */
    public function __construct( ShipperRepositoryInterface $shipperRepository )
    {
        $this -> theRepository = $shipperRepository;
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
     * @param ShipperRequest $shipperRequest
     * @return JsonResponse
     */
    public function store( ShipperRequest $shipperRequest ) : JsonResponse
    {
        return $this -> theRepository -> store( $shipperRequest );
    }

    /**
     * Display the specified resource.
     *
     * @param Shipper $shipper
     * @return JsonResponse
     */
    public function show( Shipper $shipper ) : JsonResponse
    {
        return $this -> theRepository -> show( $shipper );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ShipperRequest $shipperRequest
     * @param Shipper $shipper
     * @return JsonResponse
     */
    public function update( ShipperRequest $shipperRequest, Shipper $shipper ) : JsonResponse
    {
        return $this -> theRepository -> update( $shipperRequest, $shipper );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Shipper $shipper
     * @return JsonResponse
     */
    public function destroy( Shipper $shipper ) : JsonResponse
    {
        return $this -> theRepository -> destroy( $shipper );
    }
}
