<?php

namespace App\Jobs\Juaso\Resource\DeliveryMethod;

use App\Http\Requests\Juaso\Resource\DeliveryMethod\DeliveryMethodRequest;
use App\Http\Resources\Juaso\Resource\DeliveryMethod\DeliveryMethodResource;
use App\Models\Juaso\Resource\DeliveryMethod\DeliveryMethod;

use App\Traits\apiResponseBuilder;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class CreateDeliveryMethod implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,apiResponseBuilder;
    private DeliveryMethodRequest $theRequest;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( DeliveryMethodRequest $deliveryMethodRequest )
    {
        $this -> theRequest = $deliveryMethodRequest;
    }

    /**
     * Execute the job.
     *
     * @return DeliveryMethodResource|mixed
     */
    public function handle() : DeliveryMethodResource
    {
        try
        {
            $DeliveryMethod = new DeliveryMethod( $this -> theRequest -> input( 'data.attributes' ) );
            $DeliveryMethod -> save();

            $DeliveryMethod -> refresh();
            return ( new DeliveryMethodResource( $DeliveryMethod ) );
        }

        catch ( Exception $exception )
        {
            report( $exception );
            return abort( $this -> errorResponse( null, 'Error', 'Something went wrong, please try again later', Response::HTTP_SERVICE_UNAVAILABLE ) );
        }
    }
}
