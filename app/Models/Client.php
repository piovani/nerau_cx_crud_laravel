<?php

namespace App\Models;

/**
 * Class Client
 * @package App\Models
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $phone
 */
class Client extends Domain
{
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'address',
    ];
}
