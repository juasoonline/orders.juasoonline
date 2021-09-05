<?php

namespace App\Repositories\Juaso\Resource\Shipper\Transport;

use App\Http\Requests\Juaso\Resource\Shipper\Transport\TransportRequest;
use App\Http\Resources\Juaso\Resource\Shipper\Transport\TransportResource;
use App\Jobs\Juaso\Resource\Shipper\Transport\CreateTransport;
use App\Jobs\Juaso\Resource\Shipper\Transport\UpdateTransport;
use App\Models\Juaso\Resource\Shipper\Shipper\Shipper;
use App\Models\Juaso\Resource\Shipper\Transport\Transport;

use App\Traits\apiResponseBuilder;
use App\Traits\Relatives;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class TransportRepository implements TransportRepositoryInterface
{
    use apiResponseBuilder, Relatives;

    /**
     * @param Shipper $shipper
     * @return JsonResponse
     */
    public function index( Shipper $shipper ) : JsonResponse
    {
        return $this -> successResponse( TransportResource::collection( $shipper -> transports() -> paginate() ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param Shipper $shipper
     * @param TransportRequest $transportRequest
     * @return JsonResponse
     */
    public function store( Shipper $shipper, TransportRequest $transportRequest ) : JsonResponse
    {
        return $this -> successResponse( ( new CreateTransport( $shipper, $transportRequest ) ) -> handle(), "Success", "Transport created", Response::HTTP_CREATED );
    }

    /**
     * @param Shipper $shipper
     * @param Transport $transport
     * @return JsonResponse
     */
    public function show( Shipper $shipper, Transport $transport ) : JsonResponse
    {
        checkResourceRelation( $shipper -> transports() -> where( 'transports.id', $transport -> id ) -> count());
        if ( $this -> loadRelationships() ) { $transport -> load( $this -> relationships ); }
        return $this -> successResponse( new TransportResource( $transport ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param Shipper $shipper
     * @param TransportRequest $transportRequest
     * @param Transport $transport
     * @return JsonResponse
     */
    public function update( Shipper $shipper, TransportRequest $transportRequest, Transport $transport ) : JsonResponse
    {
        checkResourceRelation( $shipper -> transports() -> where( 'transports.id', $transport -> id ) -> count());
        return $this -> successResponse( ( new UpdateTransport( $transportRequest, $transport ) ) -> handle(), 'Success', 'Agent updated', Response::HTTP_OK );
    }

    /**
     * @param Shipper $shipper
     * @param Transport $transport
     * @return JsonResponse|mixed
     */
    public function destroy( Shipper $shipper, Transport $transport ) : JsonResponse
    {
        checkResourceRelation( $shipper -> transports() -> where( 'transports.id', $transport -> id ) -> count());
        try
        {
            $transport -> delete();
            return $this -> successResponse( null, 'Success', 'Transport deleted', Response::HTTP_NO_CONTENT );
        }
        catch ( Exception $exception )
        {
            report( $exception );
            return abort( $this -> errorResponse( null, 'Error', 'Something went wrong, please try again later', Response::HTTP_SERVICE_UNAVAILABLE ) );
        }
    }
}
