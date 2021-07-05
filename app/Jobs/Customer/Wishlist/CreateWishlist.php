<?php

namespace App\Jobs\Customer\Wishlist;

use App\Http\Requests\Customer\Wishlist\WishlistRequest;
use App\Http\Resources\Customer\Wishlist\WishlistResource;
use App\Models\Customer\Customer;
use App\Models\Customer\Wishlist\Wishlist;
use App\Traits\apiResponseBuilder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class CreateWishlist implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, apiResponseBuilder;
    private Customer $theCustomer; private WishlistRequest $theRequest;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( Customer $customer, WishlistRequest $wishlistRequest )
    {
        $this -> theCustomer = $customer;
        $this -> theRequest = $wishlistRequest;
    }

    /**
     * Execute the job.
     *
     * @return WishlistResource|mixed
     */
    public function handle() : WishlistResource
    {
        try
        {
            $Wishlist = new Wishlist( $this -> theRequest -> input( 'data.attributes' ) );
            $Wishlist -> customer() -> associate( $this -> theRequest [ 'data.relationships.customer.customer_id' ] );
            $Wishlist -> save();

            $Wishlist -> refresh();
            return ( new WishlistResource( $Wishlist ) );
        }
        catch ( Exception $exception )
        {
            report( $exception );
            return abort( $this -> errorResponse( null, 'Error', 'Something went wrong, please try again later', Response::HTTP_SERVICE_UNAVAILABLE ) );
        }
    }
}
