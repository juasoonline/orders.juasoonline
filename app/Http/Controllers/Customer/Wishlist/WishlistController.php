<?php

namespace App\Http\Controllers\Customer\Wishlist;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Wishlist\WishlistRequest;
use App\Models\Customer\Customer;
use App\Models\Customer\Wishlist\Wishlist;
use App\Repositories\Customer\Wishlist\WishlistRepositoryInterface;
use App\Traits\apiResponseBuilder;
use App\Traits\Relatives;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    use apiResponseBuilder, Relatives;
    private WishlistRepositoryInterface $theRepository;

    /**
     * AddressController constructor.
     *
     * @param WishlistRepositoryInterface $wishlistRepository
     */
    public function __construct( WishlistRepositoryInterface $wishlistRepository )
    {
        $this -> theRepository = $wishlistRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Customer $customer
     * @return JsonResponse
     */
    public function index( Customer $customer ) : JsonResponse
    {
        return $this -> theRepository -> index( $customer );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Customer $customer
     * @param WishlistRequest $wishlistRequest
     * @return JsonResponse
     */
    public function store( Customer $customer, WishlistRequest $wishlistRequest ) : JsonResponse
    {
        return $this -> theRepository -> store( $customer, $wishlistRequest );
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @param Wishlist $wishlist
     * @return JsonResponse
     */
    public function show( Customer $customer, Wishlist $wishlist ) : JsonResponse
    {
        return $this -> theRepository -> show( $customer, $wishlist );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Customer $customer
     * @param WishlistRequest $wishlistRequest
     * @param Wishlist $wishlist
     * @return JsonResponse
     */
    public function update( Customer $customer, WishlistRequest $wishlistRequest, Wishlist $wishlist ) : JsonResponse
    {
        return $this -> theRepository -> update( $customer, $wishlistRequest, $wishlist );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @param Wishlist $wishlist
     * @return JsonResponse
     */
    public function destroy( Customer $customer, Wishlist $wishlist ) : JsonResponse
    {
        return $this -> theRepository -> destroy( $customer, $wishlist );
    }
}
