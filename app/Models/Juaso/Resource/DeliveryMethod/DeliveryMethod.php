<?php

namespace App\Models\Juaso\Resource\DeliveryMethod;

use App\Models\Juasoonline\Resource\Customer\Order\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeliveryMethod extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    /**
     * @return string
     */
    public function getRouteKeyName () : string { return 'resource_id'; }

    /**
     * @return HasMany
     */
    public function orders() : HasMany
    {
        return $this -> hasMany( Order::class );
    }
}
