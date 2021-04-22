<?php

namespace App\Jobs\Customer\Order;

use App\Http\Requests\Customer\Order\OrderRequest;
use App\Http\Resources\Customer\Order\OrderResource;
use App\Models\Customer\Order\Order;
use App\Traits\apiResponseBuilder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Response;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class UpdateOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, apiResponseBuilder;
    private OrderRequest $theRequest; private Order $theModel;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( OrderRequest $orderRequest, Order $order )
    {
        $this -> theRequest     = $orderRequest;
        $this -> theModel       = $order;
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
            $this -> theModel -> update( $this -> theRequest -> validated()[ 'data' ][ 'attributes' ] );
            return new OrderResource( $this -> theModel );
        }
        catch ( Exception $exception )
        {
            report( $exception );
            return abort( $this -> errorResponse( null, 'Error', 'Something went wrong, please try again later', Response::HTTP_SERVICE_UNAVAILABLE ) );
        }
    }
}
