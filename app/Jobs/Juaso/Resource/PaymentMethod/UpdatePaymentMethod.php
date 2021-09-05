<?php

namespace App\Jobs\Juaso\Resource\PaymentMethod;

use App\Http\Requests\Juaso\Resource\PaymentMethod\PaymentMethodRequest;
use App\Http\Resources\Juaso\Resource\PaymentMethod\PaymentMethodResource;
use App\Models\Juaso\Resource\PaymentMethod\PaymentMethod;

use App\Traits\apiResponseBuilder;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class UpdatePaymentMethod implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, apiResponseBuilder;
    private PaymentMethodRequest $theRequest; private PaymentMethod $theModel;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( PaymentMethodRequest $paymentMethodRequest, PaymentMethod $paymentMethod )
    {
        $this -> theRequest     = $paymentMethodRequest;
        $this -> theModel       = $paymentMethod;
    }

    /**
     * Execute the job.
     *
     * @return PaymentMethodResource|mixed
     */
    public function handle() : PaymentMethodResource
    {
        try
        {
            $this -> theModel -> update( $this -> theRequest -> validated()[ 'data' ][ 'attributes' ] );
            return new PaymentMethodResource( $this -> theModel );
        }
        catch ( Exception $exception )
        {
            report( $exception );
            return abort( $this -> errorResponse( null, 'Error', 'Something went wrong, please try again later', Response::HTTP_SERVICE_UNAVAILABLE ) );
        }
    }
}
