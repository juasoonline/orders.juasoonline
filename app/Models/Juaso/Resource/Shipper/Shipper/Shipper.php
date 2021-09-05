<?php

namespace App\Models\Juaso\Resource\Shipper\Shipper;

use App\Models\Juaso\Resource\Shipper\Agent\Agent;
use App\Models\Juaso\Resource\Shipper\Transport\Transport;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipper extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [ 'id' ];

    /**
     * @return string
     */
    public function getRouteKeyName () : string { return 'resource_id'; }

    /**
     * @return HasMany
     */
    public function transports(): HasMany
    {
        return $this -> hasMany( Transport::class );
    }

    /**
     * @return HasMany
     */
    public function agents(): HasMany
    {
        return $this -> hasMany( Agent::class );
    }
}
