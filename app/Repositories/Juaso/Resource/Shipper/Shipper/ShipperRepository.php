<?php

namespace App\Repositories\Juaso\Resource\Shipper\Shipper;

use App\Http\Requests\Juaso\Resource\Shipper\Shipper\ShipperRequest;
use App\Http\Resources\Juaso\Resource\Shipper\Shipper\ShipperResource;
use App\Jobs\Juaso\Resource\Shipper\Shipper\CreateShipper;
use App\Jobs\Juaso\Resource\Shipper\Shipper\UpdateShipper;
use App\Models\Juaso\Resource\Shipper\Shipper\Shipper;

use App\Traits\apiResponseBuilder;
use App\Traits\Relatives;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class ShipperRepository implements ShipperRepositoryInterface
{
    use apiResponseBuilder, Relatives;

    /**
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        $Shippers = Shipper::query() -> when( $this -> loadRelationships(), function ( Builder $builder ) { return $builder -> with ( $this -> relationships ); } ) -> paginate( 20 );
        return $this -> successResponse( ShipperResource::collection( $Shippers ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param ShipperRequest $shipperRequest
     * @return JsonResponse
     */
    public function store( ShipperRequest $shipperRequest ) : JsonResponse
    {
        return $this -> successResponse( ( new CreateShipper( $shipperRequest ) ) -> handle(), "Success", "Shipper created", Response::HTTP_CREATED );
    }

    /**
     * @param Shipper $shipper
     * @return JsonResponse
     */
    public function show( Shipper $shipper ) : JsonResponse
    {
        if ( $this -> loadRelationships() ) { $shipper -> load( $this -> relationships ); }
        return $this -> successResponse( new ShipperResource( $shipper ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param ShipperRequest $shipperRequest
     * @param Shipper $shipper
     * @return JsonResponse
     */
    public function update( ShipperRequest $shipperRequest, Shipper $shipper ) : JsonResponse
    {
        if ( $this -> loadRelationships() ) { $shipper -> load( $this -> relationships ); }
        return $this -> successResponse( ( new UpdateShipper( $shipperRequest, $shipper ) ) -> handle(), 'Success', 'Shipper updated', Response::HTTP_OK );
    }

    /**
     * @param Shipper $shipper
     * @return JsonResponse|mixed
     */
    public function destroy( Shipper $shipper ) : JsonResponse
    {
        try
        {
            $shipper -> delete();
            return $this -> successResponse( null, 'Success', 'Shipper deleted', Response::HTTP_NO_CONTENT );
        }
        catch ( Exception $exception )
        {
            report( $exception );
            return abort( $this -> errorResponse( null, 'Error', 'Something went wrong, please try again later', Response::HTTP_SERVICE_UNAVAILABLE ) );
        }
    }
}
