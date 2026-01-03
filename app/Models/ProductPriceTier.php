<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPriceTier extends Model
{
    protected $fillable = [
        'product_id',
        'min_quantity',
        'max_quantity',
        'price',
        'label',
        'sort_order',
    ];

    protected $casts = [
        'min_quantity' => 'integer',
        'max_quantity' => 'integer',
        'price' => 'decimal:2',
        'sort_order' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get formatted tier label for display
     * e.g., "50-99 units" or "100+ units"
     */
    public function getQuantityRangeAttribute()
    {
        if ($this->max_quantity) {
            return "{$this->min_quantity}-{$this->max_quantity}";
        }
        return "{$this->min_quantity}+";
    }

    /**
     * Check if a quantity falls within this tier
     */
    public function matchesQuantity($quantity)
    {
        if ($quantity < $this->min_quantity) {
            return false;
        }
        if ($this->max_quantity && $quantity > $this->max_quantity) {
            return false;
        }
        return true;
    }
}
