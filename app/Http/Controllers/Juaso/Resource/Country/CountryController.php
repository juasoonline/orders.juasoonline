<?php

namespace App\Http\Controllers\Juaso\Resource\Country;

use App\Repositories\Juaso\Resource\Country\CountryRepositoryInterface;
use App\Http\Requests\Juaso\Resource\Country\CountryRequest;
use App\Models\Juaso\Resource\Country\Country;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class CountryController extends Controller
{
    private CountryRepositoryInterface $theRepository;

    /**
     * CountryController constructor.
     * @param CountryRepositoryInterface $countryRepository
     */
    public function __construct( CountryRepositoryInterface $countryRepository )
    {
        $this -> theRepository = $countryRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        return $this -> theRepository -> index();
    }

    /**
     * @param CountryRequest $countryRequest
     * @return JsonResponse|mixed
     */
    public function store( CountryRequest $countryRequest ) : JsonResponse
    {
        return $this -> theRepository -> store( $countryRequest );
    }

    /**
     * @param Country $country
     * @return JsonResponse|mixed
     */
    public function show( Country $country ) : JsonResponse
    {
        return $this -> theRepository -> show( $country );
    }

    /**
     * @param CountryRequest $countryRequest
     * @param Country $country
     * @return JsonResponse|mixed
     */
    public function update( CountryRequest $countryRequest, Country $country ) : JsonResponse
    {
        return $this -> theRepository -> update( $countryRequest, $country );
    }

    /**
     * @param Country $country
     * @return JsonResponse
     */
    public function destroy( Country $country ) : JsonResponse
    {
        return $this -> theRepository -> destroy( $country );
    }
}
