<?php

namespace App\Jobs\Juasoonline\Resource\Customer\Order;

use App\Http\Requests\Juasoonline\Resource\Customer\Order\OrderRequest;
use App\Http\Resources\Juasoonline\Resource\Customer\Order\OrderResource;
use App\Models\Juaso\Resource\DeliveryMethod\DeliveryMethod;
use App\Models\Juasoonline\Resource\Customer\Order\Order;

use App\Traits\apiResponseBuilder;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class CreateOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, apiResponseBuilder;
    private OrderRequest $theRequest; private DeliveryMethod $theDeliveryMethod;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( OrderRequest $orderRequest )
    {
        $this -> theRequest = $orderRequest;
        $this -> theDeliveryMethod = DeliveryMethod::where( 'resource_id', '=', $this -> theRequest -> input( 'data.attributes.delivery_method_id' ) ) -> first( 'id' );
    }

    /**
     * Execute the job.
     *
     * @return OrderResource|mixed
     */
    public function handle() : OrderResource
    {
        try
        {
            $Order = new Order( $this -> theRequest -> input( 'data.attributes' ) );
            $Order -> delivery_method() -> associate( $this -> theDeliveryMethod -> id );
            $Order -> save();

            $Order -> refresh();
            return ( new OrderResource( $Order ) );
        }
        catch ( Exception $exception )
        {
            report( $exception );
            return abort( $this -> errorResponse( null, 'Error', 'Something went wrong, please try again later', Response::HTTP_SERVICE_UNAVAILABLE ) );
        }
    }
}
