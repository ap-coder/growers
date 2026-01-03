<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariation extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'product_variations';

    protected $fillable = [
        'product_id',
        'category',
        'variation_category_id',
        'name',
        'description',
        'sku',
        'upc_code',
        'base_price',
        'full_price',
        'base_cost',
        'quantity',
        'show_quantity',
        'qb_1',
        'qb_2',
        'sort_order',
        'published',
        'active',
        'is_fake',
    ];

    // Fallback categories if no VariationCategory records exist
    public const CATEGORY_SELECT = [
        'size' => 'Size',
        'color' => 'Color',
        'material' => 'Material',
        'style' => 'Style',
        'other' => 'Other',
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'base_cost' => 'decimal:2',
        'published' => 'boolean',
        'active' => 'boolean',
        'is_fake' => 'boolean',
        'show_quantity' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function clientPrices()
    {
        return $this->hasMany(VariationClientPrice::class, 'variation_id');
    }

    public function variationCategory()
    {
        return $this->belongsTo(VariationCategory::class, 'variation_category_id');
    }

    /**
     * Get the category name - from relationship or fallback to legacy field
     */
    public function getCategoryNameAttribute()
    {
        if ($this->variationCategory) {
            return $this->variationCategory->name;
        }
        return self::CATEGORY_SELECT[$this->category] ?? ucfirst($this->category ?? 'Other');
    }

    /**
     * Get the effective price for a specific client
     * Returns client-specific price if exists, otherwise base_price
     */
    public function getPriceForClient($clientId = null)
    {
        if ($clientId) {
            $clientPrice = $this->clientPrices()->where('client_id', $clientId)->first();
            if ($clientPrice && $clientPrice->price) {
                return $clientPrice->price;
            }
        }
        return $this->base_price;
    }
}
