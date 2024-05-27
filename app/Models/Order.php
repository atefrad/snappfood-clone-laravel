<?php

namespace App\Models;

use App\Services\RealTimestamp;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

/**
 * @property mixed $id
 * @property mixed $orderItems
 * @property mixed $order_status_id
 * @property mixed $orderStatus
 * @property mixed $customer_id
 * @property mixed $customer
 * @property mixed $totalDiscountAmount
 * @property mixed $totalFoodPrice
 * @property mixed $created_at
 */
class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'cart_id',
        'customer_id',
        'restaurant_id',
        'address_id',
        'payment_id',
        'order_status_id',
        'delivery_date'
    ];

    //region relation
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderStatus(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function foods(): BelongsToMany
    {
        return $this->belongsToMany(Food::class, 'order_items');
    }
    //endregion

    //region accessor
    public function totalFoodPrice(): Attribute
    {
        $totalFoodPrice = 0;

        foreach ($this->orderItems as $orderItem)
        {
            $totalFoodPrice += $orderItem->final_total_price;
        }

        return Attribute::make(
            get: fn()=> $totalFoodPrice
        );
    }

    public function totalDiscountAmount(): Attribute
    {
        $totalDiscountAmount = 0;

        foreach($this->orderItems as $orderItem)
        {
            $totalDiscountAmount += $orderItem->finalTotalDiscount;
        }
         return Attribute::make(
             get: fn()=> $totalDiscountAmount
         );
    }
    //endregion

    //region local scope
    public function scopeFilterDate(Builder $query): void
    {
        $year = Jalalian::forge(now())->getYear();
        $month = Jalalian::forge(now())->getMonth();
        $day = Jalalian::forge(now())->getDay();

        $date = new Jalalian($year, $month, $day);

        if(request()->filled('start_date'))
        {
            $startDate = RealTimestamp::getRealTimestamp(request('start_date'), '00:00:00');
            $endDate = request()->filled('end_date') ? RealTimestamp::getRealTimestamp(request('end_date'), '23:59:59'): now();
        }
        elseif(request()->filled('date') && request('date') === 'last_month')
        {
            $lastMonth = $date->getLastMonth();

            $startDate = $lastMonth->getFirstDayOfMonth()->toCarbon()->toDateTimeString();
            $endDate = $lastMonth->getEndDayOfMonth()->toCarbon()->toDateString() . " 23:59:59";
        }
        elseif (request()->filled('date') && request('date') === 'last_week')
        {
            $lastWeek = $date->getLastWeek();

            $startDate = $lastWeek->getFirstDayOfWeek()->toCarbon()->toDateTimeString();
            $endDate = $lastWeek->getEndDayOfWeek()->toCarbon()->toDateString() . " 23:59:59";
        }
        else
        {
            $startDate = null;
            $endDate = null;
        }

        $query->when(request()->filled('start_date') || request()->filled('date'), function (Builder $query) use ($startDate, $endDate) {
            $query->whereDate('created_at', '>', $startDate)
                ->where('created_at', '<', $endDate);
        });
    }
    //endregion
}
