<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'product_id',
        'variation_id',
        'quantity',
        'price',
        'sku',
        'variation_name',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variation()
    {
        return $this->belongsTo(ProductVariation::class, 'variation_id');
    }

    /**
     * Get line total for this cart item
     */
    public function getLineTotalAttribute()
    {
        return $this->quantity * $this->price;
    }

    /**
     * Scope to get cart items for current user or session
     */
    public function scopeForUserOrSession($query, $userId = null, $sessionId = null)
    {
        if ($userId) {
            return $query->where('user_id', $userId);
        }
        return $query->where('session_id', $sessionId);
    }
}
