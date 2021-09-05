<?php

namespace App\Jobs\Juaso\Resource\Shipper\Transport;

use App\Http\Requests\Juaso\Resource\Shipper\Transport\TransportRequest;
use App\Http\Resources\Juaso\Resource\Shipper\Transport\TransportResource;
use App\Models\Juaso\Resource\Shipper\Transport\Transport;

use App\Traits\apiResponseBuilder;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class UpdateTransport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, apiResponseBuilder;
    private TransportRequest $theRequest; private Transport $theModel;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( TransportRequest $transportRequest, Transport $transport )
    {
        $this -> theRequest     = $transportRequest;
        $this -> theModel       = $transport;
    }

    /**
     * Execute the job.
     *
     * @return TransportResource|mixed
     */
    public function handle() : TransportResource
    {
        try
        {
            $this -> theModel -> update( $this -> theRequest -> validated()[ 'data' ][ 'attributes' ] );
            return new TransportResource( $this -> theModel );
        }
        catch ( Exception $exception )
        {
            report( $exception );
            return abort( $this -> errorResponse( null, 'Error', 'Something went wrong, please try again later', Response::HTTP_SERVICE_UNAVAILABLE ) );
        }
    }
}
