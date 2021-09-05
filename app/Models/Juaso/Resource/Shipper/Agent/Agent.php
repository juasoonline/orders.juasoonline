<?php

namespace App\Models\Juaso\Resource\Shipper\Agent;

use App\Models\Juaso\Resource\Shipper\Shipper\Shipper;
use App\Models\Juaso\Resource\Shipper\Transport\Transport;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Agent extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    /**
     * @return string
     */
    public function getRouteKeyName () : string { return 'resource_id'; }

    /**
     * @return BelongsTo
     */
    public function shipper(): BelongsTo
    {
        return $this -> belongsTo( Shipper::class );
    }

    /**
     * @return BelongsTo
     */
    public function transport(): BelongsTo
    {
        return $this -> belongsTo( Transport::class );
    }
}
