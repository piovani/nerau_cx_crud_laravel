<?php

namespace App\Models;

/**
 * Class Product
 * @package App\Models
 *
 * @property string $id
 * @property string $name
 * @property float $price
 * @property float $weight
 * @property string $image
 * @property string $description
 * @property int $stock
 * @property string $status
 */
class Product extends Domain
{
    protected $fillable = [
        'id',
        'name',
        'price',
        'weight',
        'image',
        'description',
        'stock',
        'status',
    ];

    public function subtractStock(int $amount): void
    {
        $this->stock -= $amount;
        $this->save();
    }
}
