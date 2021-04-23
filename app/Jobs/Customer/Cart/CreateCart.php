<?php

namespace App\Jobs\Customer\Cart;

use App\Http\Requests\Customer\Cart\CartRequest;
use App\Http\Resources\Customer\Cart\CartResource;
use App\Models\Customer\Cart\Cart;
use App\Models\Customer\Customer;
use App\Traits\apiResponseBuilder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Response;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class CreateCart implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, apiResponseBuilder;
    private Customer $theCustomer; private CartRequest $theRequest;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( Customer $customer, CartRequest $cartRequest )
    {
        $this -> theCustomer = $customer;
        $this -> theRequest = $cartRequest;
    }

    /**
     * Execute the job.
     *
     * @return CartResource|mixed
     */
    public function handle() : CartResource
    {
        try
        {
            $Cart = new Cart( $this -> theRequest -> input( 'data.attributes' ) );
            $Cart -> customer() -> associate( $this -> theRequest [ 'data.relationships.customer.customer_id' ] );
            $Cart -> save();

            $Cart -> refresh();
            return ( new CartResource( $Cart ) );
        }
        catch ( Exception $exception )
        {
            report( $exception );
            return abort( $this -> errorResponse( null, 'Error', 'Something went wrong, please try again later', Response::HTTP_SERVICE_UNAVAILABLE ) );
        }
    }
}
