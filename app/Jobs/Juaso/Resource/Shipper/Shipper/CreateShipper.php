<?php

namespace App\Jobs\Juaso\Resource\Shipper\Shipper;

use App\Http\Requests\Juaso\Resource\Shipper\Shipper\ShipperRequest;
use App\Http\Resources\Juaso\Resource\Shipper\Shipper\ShipperResource;
use App\Models\Juaso\Resource\Shipper\Shipper\Shipper;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class CreateShipper implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private ShipperRequest $theRequest;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( ShipperRequest $shipperRequest )
    {
        $this -> theRequest = $shipperRequest;
    }

    /**
     * Execute the job.
     *
     * @return ShipperResource|mixed
     */
    public function handle() : ShipperResource
    {
        try
        {
            $Shipper = new Shipper( $this -> theRequest -> input( 'data.attributes' ) );
            $Shipper -> save();

            $Shipper -> refresh();
            return ( new ShipperResource( $Shipper ) );
        }
        catch ( Exception $exception )
        {
            report( $exception );
            return abort(500, 'something went wrong, please try again later');
        }
    }
}
