<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
    ];

    public function products(): ?BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function routeNotificationFor($driver, $notification = null)
    {
        return $this->email;
    }
}
