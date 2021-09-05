<?php

namespace App\Jobs\Juaso\Resource\DeliveryMethod;

use App\Http\Requests\Juaso\Resource\DeliveryMethod\DeliveryMethodRequest;
use App\Http\Resources\Juaso\Resource\DeliveryMethod\DeliveryMethodResource;
use App\Http\Resources\Juaso\Resource\PaymentMethod\PaymentMethodResource;
use App\Models\Juaso\Resource\DeliveryMethod\DeliveryMethod;

use App\Traits\apiResponseBuilder;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class UpdateDeliveryMethod implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, apiResponseBuilder;
    private DeliveryMethodRequest $theRequest; private DeliveryMethod $theModel;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( DeliveryMethodRequest $deliveryMethodRequest, DeliveryMethod $deliveryMethod )
    {
        $this -> theRequest     = $deliveryMethodRequest;
        $this -> theModel       = $deliveryMethod;
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
            $this -> theModel -> update( $this -> theRequest -> validated()[ 'data' ][ 'attributes' ] );
            return new DeliveryMethodResource( $this -> theModel );
        }
        catch ( Exception $exception )
        {
            report( $exception );
            return abort( $this -> errorResponse( null, 'Error', 'Something went wrong, please try again later', Response::HTTP_SERVICE_UNAVAILABLE ) );
        }
    }
}
