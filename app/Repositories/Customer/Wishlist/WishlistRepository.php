<?php

namespace App\Repositories\Customer\Wishlist;

use App\Http\Requests\Customer\Wishlist\WishlistRequest;
use App\Http\Resources\Customer\Wishlist\WishlistResource;
use App\Jobs\Customer\Wishlist\CreateWishlist;
use App\Jobs\Customer\Wishlist\UpdateWishlist;
use App\Models\Customer\Customer;
use App\Models\Customer\Wishlist\Wishlist;
use App\Traits\apiResponseBuilder;
use App\Traits\Relatives;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class WishlistRepository implements WishlistRepositoryInterface
{
    use apiResponseBuilder, Relatives;

    /**
     * @param Customer $customer
     * @return JsonResponse
     */
    public function index( Customer $customer ) : JsonResponse
    {
        return $this -> successResponse( WishlistResource::collection( $customer -> wishlists() -> paginate() ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param Customer $customer
     * @param WishlistRequest $wishlistRequest
     * @return JsonResponse
     */
    public function store( Customer $customer, WishlistRequest $wishlistRequest ) : JsonResponse
    {
        return $this -> successResponse( ( new CreateWishlist( $customer, $wishlistRequest ) ) -> handle(), "Success", "Product(s) added to wishlist", Response::HTTP_CREATED );
    }

    /**
     * @param Customer $customer
     * @param Wishlist $wishlist
     * @return JsonResponse
     */
    public function show( Customer $customer, Wishlist $wishlist ) : JsonResponse
    {
        checkResourceRelation( $customer -> wishlists() -> where( 'wishlists.id', $wishlist -> id ) -> count());
        if ( $this -> loadRelationships() ) { $wishlist -> load( $this -> relationships ); }
        return $this -> successResponse( new WishlistResource( $wishlist ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param Customer $customer
     * @param WishlistRequest $wishlistRequest
     * @param Wishlist $wishlist
     * @return JsonResponse
     */
    public function update( Customer $customer, WishlistRequest $wishlistRequest, Wishlist $wishlist ) : JsonResponse
    {
        checkResourceRelation( $customer -> wishlists() -> where( 'wishlists.id', $wishlist -> id ) -> count());
        return $this -> successResponse( ( new UpdateWishlist( $wishlistRequest, $wishlist ) ) -> handle(), 'Success', 'Wishlist item(s) updated', Response::HTTP_OK );
    }

    /**
     * @param Customer $customer
     * @param Wishlist $wishlist
     * @return JsonResponse
     */
    public function destroy( Customer $customer, Wishlist $wishlist ) : JsonResponse
    {
        checkResourceRelation( $customer -> wishlists() -> where( 'wishlists.id', $wishlist -> id ) -> count());
        $wishlist -> delete();
        return $this -> successResponse( null, 'Success', 'Wishlist item(s) deleted', Response::HTTP_NO_CONTENT );
    }
}
