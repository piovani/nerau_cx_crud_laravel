<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use phpDocumentor\Reflection\Types\Integer;

/**
 * Class Order
 * @package App\Models
 *
 * @property string $id
 * @property int $code
 * @property string $client_id
 * @property string $status
 * @property float $subtotal_products
 * @property float $value_freight
 * @property float $total
 * @property string $form_payment
 * @property string $form_delivery
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property Collection $items
 */
class Order extends Domain
{
    protected $fillable = [
        'id',
        'code',
        'client_id',
        'status',
        'subtotal_products',
        'value_freight',
        'total',
        'form_payment',
        'form_delivery',
    ];

    protected $with = [
        'items',
    ];

    const STATUS_OPEN = 'open';

    const STATUS = [
        self::STATUS_OPEN,
    ];

    const FORM_PAYMENT_CASH = 'a vista';
    const FORM_PAYMENT_TERM = 'a prazo';

    const FORM_PAYMENT = [
        self::FORM_PAYMENT_CASH,
        self::FORM_PAYMENT_TERM,
    ];

    const FORM_DELIVERY_POST = 'correios';

    const FORM_DELIVERY = [
        self::FORM_DELIVERY_POST,
        'sjdaisjd'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function totalProducts(): float
    {
        return $this->items->sum('total');
    }

    public function sumValueFreight(): float
    {
        $valueForKg = (float) env('VALUE_FREIGHT_KG');
        $weight = 0.00;
        $partOrderPrice = $this->totalProducts() * 0.05;

        $this->items->each(function ($item) use (&$weight) {
            $weight += $item->product->weight * $item->amount;
        });

        return ($valueForKg * $weight) + $partOrderPrice;
    }

    public static function nextCode(): int
    {
        $lastCode = Order::query()->select()->max('code');

        if (empty($lastCode)) {
            return 1;
        }

        return ++$lastCode;
    }
}
