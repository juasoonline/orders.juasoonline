<?php

namespace App\Repositories\Juaso\Resource\Shipper\Transport;

use App\Http\Requests\Juaso\Resource\Shipper\Transport\TransportRequest;
use App\Models\Juaso\Resource\Shipper\Shipper\Shipper;
use App\Models\Juaso\Resource\Shipper\Transport\Transport;

use Illuminate\Http\JsonResponse;

interface TransportRepositoryInterface
{
    /**
     * @param Shipper $shipper
     * @return JsonResponse
     */
    public function index( Shipper $shipper ) : JsonResponse;

    /**
     * @param Shipper $shipper
     * @param TransportRequest $transportRequest
     * @return JsonResponse
     */
    public function store( Shipper $shipper, TransportRequest $transportRequest ) : JsonResponse;

    /**
     * @param Shipper $shipper
     * @param Transport $transport
     * @return JsonResponse
     */
    public function show( Shipper $shipper, Transport $transport ) : JsonResponse;

    /**
     * @param Shipper $shipper
     * @param TransportRequest $transportRequest
     * @param Transport $transport
     * @return JsonResponse
     */
    public function update( Shipper $shipper, TransportRequest $transportRequest, Transport $transport ) : JsonResponse;

    /**
     * @param Shipper $shipper
     * @param Transport $transport
     * @return JsonResponse
     */
    public function destroy( Shipper $shipper, Transport $transport ) : JsonResponse;
}
