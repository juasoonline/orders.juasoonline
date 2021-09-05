<?php

namespace App\Repositories\Juaso\Resource\Shipper\Shipper;

use App\Http\Requests\Juaso\Resource\Shipper\Shipper\ShipperRequest;
use App\Models\Juaso\Resource\Shipper\Shipper\Shipper;

use Illuminate\Http\JsonResponse;

interface ShipperRepositoryInterface
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse;

    /**
     * @param ShipperRequest $shipperRequest
     * @return JsonResponse
     */
    public function store( ShipperRequest $shipperRequest ) : JsonResponse;

    /**
     * @param Shipper $shipper
     * @return JsonResponse
     */
    public function show( Shipper $shipper ) : JsonResponse;

    /**
     * @param ShipperRequest $shipperRequest
     * @param Shipper $shipper
     * @return JsonResponse
     */
    public function update( ShipperRequest $shipperRequest, Shipper $shipper ) : JsonResponse;

    /**
     * @param Shipper $shipper
     * @return JsonResponse
     */
    public function destroy( Shipper $shipper ) : JsonResponse;
}
