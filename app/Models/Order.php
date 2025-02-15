<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'orders';

    protected $fillable = [
        'email',
        'country_code',
        'zip_postal_code',
        'city',
        'shipping_address_1',
        'shipping_address_2',
        'shipping_address_3',
        'phone_number',
    ];

    public function products(): ?BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'orders_products');
    }
}
