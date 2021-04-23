<?php

namespace App\Jobs\Customer\Address;

use App\Http\Requests\Customer\Address\AddressRequest;
use App\Http\Resources\Customer\Address\AddressResource;
use App\Models\Customer\Address\Address;
use App\Models\Customer\Customer;
use App\Traits\apiResponseBuilder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class CreateAddress implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, apiResponseBuilder;
    private Customer $theCustomer; private AddressRequest $theRequest;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( Customer $customer, AddressRequest $addressRequest )
    {
        $this -> theCustomer = $customer;
        $this -> theRequest = $addressRequest;
    }

    /**
     * Execute the job.
     *
     * @return AnonymousResourceCollection|mixed
     */
    public function handle() : AnonymousResourceCollection
    {
        try
        {
            foreach ( $this -> theRequest [ 'data.addresses.data' ] as $address )
            {
                $address = new Address( $address );
                $address -> customer() -> associate( $this -> theRequest [ 'data.relationships.customer.customer_id' ] );
                $address -> save();
            }
            return AddressResource::collection( $this -> theCustomer -> addresses() -> paginate() );
        }
        catch ( Exception $exception )
        {
            report( $exception );
            return abort( $this -> errorResponse( null, 'Error', 'Something went wrong, please try again later', Response::HTTP_SERVICE_UNAVAILABLE ) );
        }
    }
}
