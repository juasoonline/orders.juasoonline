<?php

namespace App\Jobs\Customer\Cart;

use App\Http\Requests\Customer\Cart\CartRequest;
use App\Http\Resources\Customer\Cart\CartResource;
use App\Models\Customer\Cart\Cart;
use App\Traits\apiResponseBuilder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class UpdateCart implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, apiResponseBuilder;
    private CartRequest $theRequest; private Cart $theModel;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( CartRequest $cartRequest, Cart $cart )
    {
        $this -> theRequest     = $cartRequest;
        $this -> theModel       = $cart;
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
            $this -> theModel -> update( $this -> theRequest -> validated()[ 'data' ][ 'attributes' ] );
            return new CartResource( $this -> theModel );
        }
        catch ( Exception $exception )
        {
            report( $exception );
            return abort( $this -> errorResponse( null, 'Error', 'Something went wrong, please try again later', Response::HTTP_SERVICE_UNAVAILABLE ) );
        }
    }
}
