<?php

namespace App\Jobs\Customer\Order;

use App\Http\Requests\Customer\Order\OrderRequest;
use App\Http\Resources\Customer\Order\OrderResource;
use App\Models\Customer\Customer;
use App\Models\Customer\Order\Order;
use App\Traits\apiResponseBuilder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Response;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class CreateOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, apiResponseBuilder;
    private Customer $theCustomer; private OrderRequest $theRequest;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( Customer $customer, OrderRequest $orderRequest )
    {
        $this -> theCustomer = $customer;
        $this -> theRequest = $orderRequest;
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
            $Order -> customer() -> associate( $this -> theRequest [ 'data.relationships.customer.customer_id' ] );
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
