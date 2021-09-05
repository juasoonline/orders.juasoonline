<?php

namespace App\Jobs\Juaso\Resource\Shipper\Agent;

use App\Http\Requests\Juaso\Resource\Shipper\Agent\AgentRequest;
use App\Http\Resources\Juaso\Resource\Shipper\Agent\AgentResource;
use App\Models\Juaso\Resource\Shipper\Agent\Agent;
use App\Models\Juaso\Resource\Shipper\Shipper\Shipper;

use App\Traits\apiResponseBuilder;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class CreateAgent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, apiResponseBuilder;
    private Shipper $theModel; private AgentRequest $theRequest;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( Shipper $shipper , AgentRequest $agentRequest )
    {
        $this -> theModel = $shipper;
        $this -> theRequest = $agentRequest;
    }

    /**
     * Execute the job.
     *
     * @return AgentResource|mixed
     */
    public function handle() : AgentResource
    {
        try
        {
            $Agent = new Agent( $this -> theRequest -> input( 'data.attributes' ) );
            $Agent -> shipper() -> associate( $this -> theModel -> id );
            $Agent -> save();

            $Agent -> refresh();
            return ( new AgentResource( $Agent ) );
        }
        catch ( Exception $exception )
        {
            report( $exception );
            return abort(500, 'something went wrong, please try again later');
        }
    }
}
