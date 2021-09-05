<?php

namespace App\Http\Controllers\Juaso\Resource\Shipper\Transport;

use App\Repositories\Juaso\Resource\Shipper\Transport\TransportRepositoryInterface;
use App\Http\Requests\Juaso\Resource\Shipper\Transport\TransportRequest;
use App\Models\Juaso\Resource\Shipper\Shipper\Shipper;
use App\Models\Juaso\Resource\Shipper\Transport\Transport;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class TransportController extends Controller
{
    private TransportRepositoryInterface $theRepository;

    /**
     * ShipperController constructor.
     *
     * @param TransportRepositoryInterface $transportRepository
     */
    public function __construct( TransportRepositoryInterface $transportRepository )
    {
        $this -> theRepository = $transportRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Shipper $shipper
     * @return JsonResponse
     */
    public function index( Shipper $shipper ) : JsonResponse
    {
        return $this -> theRepository -> index( $shipper );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Shipper $shipper
     * @param TransportRequest $transportRequest
     * @return JsonResponse
     */
    public function store( Shipper $shipper, TransportRequest $transportRequest ) : JsonResponse
    {
        return $this -> theRepository -> store( $shipper, $transportRequest );
    }

    /**
     * Display the specified resource.
     *
     * @param Shipper $shipper
     * @param Transport $transport
     * @return JsonResponse
     */
    public function show( Shipper $shipper, Transport $transport ) : JsonResponse
    {
        return $this -> theRepository -> show( $shipper, $transport );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Shipper $shipper
     * @param TransportRequest $transportRequest
     * @param Transport $transport
     * @return JsonResponse
     */
    public function update( Shipper $shipper, TransportRequest $transportRequest, Transport $transport ) : JsonResponse
    {
        return $this -> theRepository -> update( $shipper, $transportRequest, $transport );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Shipper $shipper
     * @param Transport $transport
     * @return JsonResponse
     */
    public function destroy( Shipper $shipper, Transport $transport ) : JsonResponse
    {
        return $this -> theRepository -> destroy( $shipper, $transport );
    }
}
