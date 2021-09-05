<?php

namespace App\Jobs\Juaso\Resource\Shipper\Shipper;

use App\Http\Requests\Juaso\Resource\Shipper\Shipper\ShipperRequest;
use App\Http\Resources\Juaso\Resource\Shipper\Shipper\ShipperResource;
use App\Models\Juaso\Resource\Shipper\Shipper\Shipper;

use App\Traits\apiResponseBuilder;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class UpdateShipper implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, apiResponseBuilder;
    private ShipperRequest $theRequest; private Shipper $theModel;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( ShipperRequest $shipperRequest, Shipper $shipper )
    {
        $this -> theRequest     = $shipperRequest;
        $this -> theModel       = $shipper;
    }

    /**
     * Execute the job.
     *
     * @return ShipperResource|mixed
     */
    public function handle() : ShipperResource
    {
        try
        {
            $this -> theModel -> update( $this -> theRequest -> validated()[ 'data' ][ 'attributes' ] );
            return new ShipperResource( $this -> theModel );
        }
        catch ( Exception $exception )
        {
            report( $exception );
            return abort( $this -> errorResponse( null, 'Error', 'Something went wrong, please try again later', Response::HTTP_SERVICE_UNAVAILABLE ) );
        }
    }
}
