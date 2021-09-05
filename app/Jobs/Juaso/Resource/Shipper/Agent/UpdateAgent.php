<?php

namespace App\Jobs\Juaso\Resource\Shipper\Agent;

use App\Http\Requests\Juaso\Resource\Shipper\Agent\AgentRequest;
use App\Http\Resources\Juaso\Resource\Shipper\Agent\AgentResource;
use App\Models\Juaso\Resource\Shipper\Agent\Agent;

use App\Traits\apiResponseBuilder;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Response;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class UpdateAgent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, apiResponseBuilder;
    private AgentRequest $theRequest; private Agent $theModel;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( AgentRequest $agentRequest, Agent $agent )
    {
        $this -> theRequest     = $agentRequest;
        $this -> theModel       = $agent;
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
            $this -> theModel -> update( $this -> theRequest -> validated()[ 'data' ][ 'attributes' ] );
            return new AgentResource( $this -> theModel );
        }
        catch ( Exception $exception )
        {
            report( $exception );
            return abort( $this -> errorResponse( null, 'Error', 'Something went wrong, please try again later', Response::HTTP_SERVICE_UNAVAILABLE ) );
        }
    }
}
