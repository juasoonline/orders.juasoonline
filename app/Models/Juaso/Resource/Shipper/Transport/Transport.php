<?php

namespace App\Models\Juaso\Resource\Shipper\Transport;

use App\Models\Juaso\Resource\Shipper\Agent\Agent;
use App\Models\Juasoonline\Resource\Order\Order;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transport extends Model
{
    use HasFactory, SoftDeletes;

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
        return $this -> belongsTo( Transport::class );
    }

    /**
     * @return BelongsTo
     */
    public function agent(): BelongsTo
    {
        return $this -> belongsTo( Agent::class );
    }

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this -> hasMany( Order::class );
    }
}
