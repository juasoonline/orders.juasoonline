<?php

namespace App\Models\Juasoonline\Resource\Customer\Order;

use App\Models\Juaso\Resource\DeliveryMethod\DeliveryMethod;
use App\Models\Juaso\Resource\PaymentMethod\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
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
    public function delivery_method() : BelongsTo
    {
        return $this -> belongsTo( DeliveryMethod::class );
    }

    /**
     * @return BelongsTo
     */
    public function payment_method() : BelongsTo
    {
        return $this -> belongsTo( PaymentMethod::class );
    }
}
