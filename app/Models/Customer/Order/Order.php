<?php

namespace App\Models\Customer\Order;

use App\Models\Customer\Customer;
use App\Models\Others\DeliveryFee\DeliveryFee;
use App\Models\Others\PaymentMethod\PaymentMethod;
use App\Models\Shipper\Transport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
    public function customer() : BelongsTo
    {
        return $this -> belongsTo( Customer::class );
    }

    /**
     * @return HasOne
     */
    public function paymentMethod() : HasOne
    {
        return $this -> hasOne( PaymentMethod::class );
    }

    /**
     * @return BelongsTo
     */
    public function transport() : BelongsTo
    {
        return $this -> belongsTo( Transport::class );
    }

    /**
     * @return HasOne
     */
    public function deliveryFee() : HasOne
    {
        return $this -> hasOne( DeliveryFee::class );
    }
}
