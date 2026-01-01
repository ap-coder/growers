<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccessoryVariant extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'accessory_variants';

    protected $fillable = [
        'accessory_id',
        'name',
        'color',
        'size',
        'material',
        'sku',
        'price_adjustment',
        'price_override',
        'is_default',
        'published',
        'sort_order',
        'stock_quantity',
    ];

    public const MATERIALS = [
        'wicker' => 'Wicker',
        'glass' => 'Glass',
        'ceramic' => 'Ceramic',
        'plastic' => 'Plastic',
        'metal' => 'Metal',
        'wood' => 'Wood',
        'fabric' => 'Fabric',
        'paper' => 'Paper',
    ];

    protected $casts = [
        'price_adjustment' => 'decimal:2',
        'price_override' => 'decimal:2',
        'is_default' => 'boolean',
        'published' => 'boolean',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function accessory()
    {
        return $this->belongsTo(Accessory::class, 'accessory_id');
    }

    /**
     * Get the effective price for this variant
     * If price_override is set, use it; otherwise use accessory base_price + adjustment
     */
    public function getEffectivePrice($clientId = null)
    {
        if ($this->price_override !== null) {
            return $this->price_override;
        }

        $basePrice = $this->accessory?->getPriceForClient($clientId) ?? $this->accessory?->base_price ?? 0;
        return $basePrice + ($this->price_adjustment ?? 0);
    }

    /**
     * Get display name with color/size/material
     */
    public function getDisplayNameAttribute()
    {
        $parts = [];
        if ($this->color) $parts[] = $this->color;
        if ($this->size) $parts[] = $this->size;
        if ($this->material) $parts[] = self::MATERIALS[$this->material] ?? $this->material;
        
        if (empty($parts)) {
            return $this->name;
        }
        
        return $this->name ?: implode(' - ', $parts);
    }

    /**
     * Get price difference text for display
     */
    public function getPriceDifferenceTextAttribute()
    {
        if ($this->price_override !== null) {
            return '$' . number_format($this->price_override, 2);
        }
        
        if ($this->price_adjustment > 0) {
            return '+$' . number_format($this->price_adjustment, 2);
        } elseif ($this->price_adjustment < 0) {
            return '-$' . number_format(abs($this->price_adjustment), 2);
        }
        
        return '';
    }
}
