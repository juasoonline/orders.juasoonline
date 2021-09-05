<?php

namespace App\Repositories\Juaso\Resource\Shipper\Agent;

use App\Http\Requests\Juaso\Resource\Shipper\Agent\AgentRequest;
use App\Models\Juaso\Resource\Shipper\Agent\Agent;
use App\Models\Juaso\Resource\Shipper\Shipper\Shipper;

use Illuminate\Http\JsonResponse;

interface AgentRepositoryInterface
{
    /**
     * @param Shipper $shipper
     * @return JsonResponse
     */
    public function index( Shipper $shipper ) : JsonResponse;

    /**
     * @param Shipper $shipper
     * @param AgentRequest $agentRequest
     * @return JsonResponse
     */
    public function store( Shipper $shipper, AgentRequest $agentRequest ) : JsonResponse;

    /**
     * @param Shipper $shipper
     * @param Agent $agent
     * @return JsonResponse
     */
    public function show( Shipper $shipper, Agent $agent ) : JsonResponse;

    /**
     * @param Shipper $shipper
     * @param AgentRequest $agentRequest
     * @param Agent $agent
     * @return JsonResponse
     */
    public function update( Shipper $shipper, AgentRequest $agentRequest, Agent $agent ) : JsonResponse;

    /**
     * @param Shipper $shipper
     * @param Agent $agent
     * @return JsonResponse
     */
    public function destroy( Shipper $shipper, Agent $agent ) : JsonResponse;
}
