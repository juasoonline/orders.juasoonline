<?php

namespace App\Jobs\Customer\Wishlist;

use App\Http\Requests\Customer\Wishlist\WishlistRequest;
use App\Http\Resources\Customer\Wishlist\WishlistResource;
use App\Models\Customer\Wishlist\Wishlist;
use App\Traits\apiResponseBuilder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Response;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class UpdateWishlist implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, apiResponseBuilder;
    private WishlistRequest $theRequest; private Wishlist $theModel;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( WishlistRequest $wishlistRequest, Wishlist $wishlist )
    {
        $this -> theRequest     = $wishlistRequest;
        $this -> theModel       = $wishlist;
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
            $this -> theModel -> update( $this -> theRequest -> validated()[ 'data' ][ 'attributes' ] );
            return new WishlistResource( $this -> theModel );
        }
        catch ( Exception $exception )
        {
            report( $exception );
            return abort( $this -> errorResponse( null, 'Error', 'Something went wrong, please try again later', Response::HTTP_SERVICE_UNAVAILABLE ) );
        }
    }
}
