<?php

namespace App\Jobs\Others\PaymentMethod;

use App\Http\Requests\Others\PaymentMethod\PaymentMethodRequest;
use App\Http\Resources\Others\PaymentMethod\PaymentMethodResource;
use App\Models\Others\PaymentMethod\PaymentMethod;
use App\Traits\apiResponseBuilder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class CreatePaymentMethod implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, apiResponseBuilder;
    private PaymentMethodRequest $theRequest;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( PaymentMethodRequest $paymentMethodRequest )
    {
        $this -> theRequest = $paymentMethodRequest;
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
            $PaymentMethod = new PaymentMethod( $this -> theRequest -> input( 'data.attributes' ) );
            $PaymentMethod -> save();

            $PaymentMethod -> refresh();
            return ( new PaymentMethodResource( $PaymentMethod ) );
        }
        catch ( Exception $exception )
        {
            report( $exception );
            return abort(500, 'something went wrong, please try again later');
        }
    }
}
