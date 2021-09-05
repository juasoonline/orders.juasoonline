<?php

namespace App\Repositories\Juaso\Resource\Shipper\Agent;

use App\Http\Requests\Juaso\Resource\Shipper\Agent\AgentRequest;
use App\Http\Resources\Juaso\Resource\Shipper\Agent\AgentResource;
use App\Jobs\Juaso\Resource\Shipper\Agent\CreateAgent;
use App\Jobs\Juaso\Resource\Shipper\Agent\UpdateAgent;
use App\Models\Juaso\Resource\Shipper\Agent\Agent;
use App\Models\Juaso\Resource\Shipper\Shipper\Shipper;

use App\Traits\apiResponseBuilder;
use App\Traits\Relatives;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class AgentRepository implements AgentRepositoryInterface
{
    use apiResponseBuilder, Relatives;

    /**
     * @param Shipper $shipper
     * @return JsonResponse
     */
    public function index( Shipper $shipper ) : JsonResponse
    {
        return $this -> successResponse( AgentResource::collection( $shipper -> agents() -> paginate() ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param Shipper $shipper
     * @param AgentRequest $agentRequest
     * @return JsonResponse
     */
    public function store( Shipper $shipper, AgentRequest $agentRequest ) : JsonResponse
    {
        return $this -> successResponse( ( new CreateAgent( $shipper, $agentRequest ) ) -> handle(), "Success", "Agent created", Response::HTTP_CREATED );
    }

    /**
     * @param Shipper $shipper
     * @param Agent $agent
     * @return JsonResponse
     */
    public function show( Shipper $shipper, Agent $agent ) : JsonResponse
    {
        checkResourceRelation( $shipper -> agents() -> where( 'agents.id', $agent -> id ) -> count());
        if ( $this -> loadRelationships() ) { $agent -> load( $this -> relationships ); }
        return $this -> successResponse( new AgentResource( $agent ), "Success", null, Response::HTTP_OK );
    }

    /**
     * @param Shipper $shipper
     * @param AgentRequest $agentRequest
     * @param Agent $agent
     * @return JsonResponse
     */
    public function update( Shipper $shipper, AgentRequest $agentRequest, Agent $agent ) : JsonResponse
    {
        checkResourceRelation( $shipper -> agents() -> where( 'agents.id', $agent -> id ) -> count());
        return $this -> successResponse( ( new UpdateAgent( $agentRequest, $agent ) ) -> handle(), 'Success', 'Agent updated', Response::HTTP_OK );
    }

    /**
     * @param Shipper $shipper
     * @param Agent $agent
     * @return JsonResponse|mixed
     */
    public function destroy( Shipper $shipper, Agent $agent ) : JsonResponse
    {
        checkResourceRelation( $shipper -> agents() -> where( 'agents.id', $agent -> id ) -> count());
        try
        {
            $agent -> delete();
            return $this -> successResponse( null, 'Success', 'Agent deleted', Response::HTTP_NO_CONTENT );
        }
        catch ( Exception $exception )
        {
            report( $exception );
            return abort( $this -> errorResponse( null, 'Error', 'Something went wrong, please try again later', Response::HTTP_SERVICE_UNAVAILABLE ) );
        }
    }
}
