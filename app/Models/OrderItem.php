<?php

namespace App\Models;

use Carbon\Carbon;

/**
 * Class OrderItem
 * @package App\Models
 *
 * @property string $id
 * @property string $order_id
 * @property integer $order_code
 * @property string $product_id
 * @property string $product_name
 * @property integer $amount
 * @property float $value_unit
 * @property float $total
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class OrderItem extends Domain
{
    protected $fillable = [
        'id',
        'order_id',
        'order_code',
        'product_id',
        'product_name',
        'amount',
        'value_unit',
        'total'
    ];
}
