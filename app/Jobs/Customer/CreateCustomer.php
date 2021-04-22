<?php

namespace App\Jobs\Customer;

use App\Http\Requests\Customer\CustomerRequest;
use App\Http\Resources\Customer\CustomerResource;
use App\Models\Customer\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class CreateCustomer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $theRequest;

    /**
     * Create a new job instance.
     * @return void
     */
    public function __construct( CustomerRequest $customerRequest )
    {
        $this -> theRequest = $customerRequest;
    }

    /**
     * Execute the job.
     * @return CustomerResource|mixed
     */
    public function handle() : CustomerResource
    {
        try
        {
            $Customer = new Customer( $this -> theRequest -> input( 'data.attributes' ) );
            $Customer -> save();

            $Customer -> refresh();
            return ( new CustomerResource( $Customer ) );
        }
        catch ( Exception $exception )
        {
            report( $exception );
            return abort(500, 'something went wrong, please try again later');
        }
    }
}
