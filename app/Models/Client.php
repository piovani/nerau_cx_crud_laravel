<?php

namespace App\Models;

class Client extends Domain
{
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
    ];
}
