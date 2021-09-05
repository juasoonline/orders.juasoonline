<?php

namespace App\Http\Controllers\Juaso\Resource\Shipper\Agent;

use App\Http\Requests\Juaso\Resource\Shipper\Agent\AgentRequest;
use App\Models\Juaso\Resource\Shipper\Agent\Agent;
use App\Models\Juaso\Resource\Shipper\Shipper\Shipper;
use App\Repositories\Juaso\Resource\Shipper\Agent\AgentRepositoryInterface;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class AgentController extends Controller
{
    private AgentRepositoryInterface $theRepository;

    /**
     * ShipperController constructor.
     *
     * @param AgentRepositoryInterface $agentRepository
     */
    public function __construct( AgentRepositoryInterface $agentRepository )
    {
        $this -> theRepository = $agentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Shipper $shipper
     * @return JsonResponse
     */
    public function index( Shipper $shipper ) : JsonResponse
    {
        return $this -> theRepository -> index( $shipper );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Shipper $shipper
     * @param AgentRequest $agentRequest
     * @return JsonResponse
     */
    public function store( Shipper $shipper, AgentRequest $agentRequest ) : JsonResponse
    {
        return $this -> theRepository -> store( $shipper, $agentRequest );
    }

    /**
     * Display the specified resource.
     *
     * @param Shipper $shipper
     * @param Agent $agent
     * @return JsonResponse
     */
    public function show( Shipper $shipper, Agent $agent ) : JsonResponse
    {
        return $this -> theRepository -> show( $shipper, $agent );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Shipper $shipper
     * @param AgentRequest $agentRequest
     * @param Agent $agent
     * @return JsonResponse
     */
    public function update( Shipper $shipper, AgentRequest $agentRequest, Agent $agent ) : JsonResponse
    {
        return $this -> theRepository -> update( $shipper, $agentRequest, $agent );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Shipper $shipper
     * @param Agent $agent
     * @return JsonResponse
     */
    public function destroy( Shipper $shipper, Agent $agent ) : JsonResponse
    {
        return $this -> theRepository -> destroy( $shipper, $agent );
    }
}
