<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'address',
        'city',
        'country',
        'postal_code',
        'payment_method',
        'total_amount',
        'status'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
