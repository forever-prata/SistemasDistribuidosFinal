<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Customer extends Model
{
    protected $connection = 'mongodb';

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class, 'customer_id');
    }
}
