<?php

namespace App\Jobs\Juaso\Resource\Country;

use App\Http\Requests\Juaso\Resource\Country\CountryRequest;
use App\Http\Resources\Juaso\Resource\Country\CountryResource;
use App\Models\Juaso\Resource\Country\Country;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class UpdateCountry implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private CountryRequest $theRequest; private Country $theModel;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( CountryRequest $countryRequest, Country $country )
    {
        $this -> theRequest     = $countryRequest;
        $this -> theModel       = $country;
    }

    /**
     * Execute the job.
     *
     * @return CountryResource|mixed
     */
    public function handle() : CountryResource
    {
        try
        {
            $this -> theModel -> update( $this -> theRequest -> validated()[ 'data' ][ 'attributes' ] );
            return new CountryResource( $this -> theModel );
        }
        catch ( Exception $exception )
        {
            report( $exception );
            return abort( $this -> errorResponse( null, 'Error', 'Something went wrong, please try again later', Response::HTTP_SERVICE_UNAVAILABLE ) );
        }
    }
}
