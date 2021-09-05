<?php

namespace App\Repositories\Juaso\Resource\Country;

use App\Http\Requests\Juaso\Resource\Country\CountryRequest;
use App\Http\Resources\Juaso\Resource\Country\CountryResource;
use App\Jobs\Juaso\Resource\Country\CreateCountry;
use App\Jobs\Juaso\Resource\Country\UpdateCountry;
use App\Models\Juaso\Resource\Country\Country;

use App\Traits\apiResponseBuilder;
use App\Traits\Relatives;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class CountryRepository implements CountryRepositoryInterface
{
    use apiResponseBuilder, Relatives;

    /**
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        $Country = Country::query() -> when( $this -> loadRelationships(), function ( Builder $builder ) { return $builder -> with ( $this -> relationships ); }) -> get();
        return $this -> successResponse( CountryResource::collection( $Country ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param CountryRequest $countryRequest
     * @return JsonResponse|mixed
     */
    public function store( CountryRequest $countryRequest ) : JsonResponse
    {
        return $this -> successResponse( ( new CreateCountry( $countryRequest ) ) -> handle(), "Success", "Country created", Response::HTTP_CREATED );
    }

    /**
     * @param Country $country
     * @return JsonResponse|mixed
     */
    public function show( Country $country ) : JsonResponse
    {
        if ( $this -> loadRelationships() ) { $country -> load( $this -> relationships ); }
        return $this -> successResponse( new CountryResource( $country ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param CountryRequest $countryRequest
     * @param Country $country
     * @return JsonResponse|mixed
     */
    public function update( CountryRequest $countryRequest, Country $country ) : JsonResponse
    {
        return $this -> successResponse( ( new UpdateCountry( $countryRequest, $country ) ) -> handle(), 'Success', 'Country updated', Response::HTTP_OK );
    }

    /**
     * @param Country $country
     * @return JsonResponse|mixed
     */
    public function destroy( Country $country ) : JsonResponse
    {
        try
        {
            $country -> delete();
            return $this -> successResponse( null, 'Success', 'Country deleted.', Response::HTTP_NO_CONTENT );
        }

        catch ( Exception $exception )
        {
            report( $exception );
            return abort( $this -> errorResponse( null, 'Error', 'Something went wrong, please try again later', Response::HTTP_SERVICE_UNAVAILABLE ) );
        }
    }
}
