<?php

namespace App\Jobs\Juaso\Resource\Country;

use App\Http\Requests\Juaso\Resource\Country\CountryRequest;
use App\Http\Resources\Juaso\Resource\Country\CountryResource;
use App\Models\Juaso\Resource\Country\Country;

use App\Traits\apiResponseBuilder;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class CreateCountry implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, apiResponseBuilder;
    private CountryRequest $theRequest;

    /**
     * Create a new job instance.
     *
     * @param CountryRequest $countryRequest
     */
    public function __construct( CountryRequest $countryRequest )
    {
        $this -> theRequest = $countryRequest;
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
            $Country = new Country( $this -> theRequest -> input( 'data.attributes' ) );
            $Country -> save();

            $Country -> refresh();
            return ( new CountryResource( $Country ) );
        }
        catch ( Exception $exception )
        {
            report( $exception );
            return abort( $this -> errorResponse( null, 'Error', 'Something went wrong, please try again later', Response::HTTP_SERVICE_UNAVAILABLE ) );
        }
    }
}
