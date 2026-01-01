<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBundleItem extends Model
{
    use HasFactory;

    public $table = 'product_bundle_items';

    protected $fillable = [
        'bundle_product_id',
        'item_product_id',
        'quantity',
        'price_override',
        'price_adjustment',
        'price_type',
        'is_required',
        'is_selectable',
        'group_name',
        'sort_order',
    ];

    public const PRICE_TYPE_DEFAULT = 'default';
    public const PRICE_TYPE_OVERRIDE = 'override';
    public const PRICE_TYPE_ADJUSTMENT = 'adjustment';
    public const PRICE_TYPE_FREE = 'free';

    public const PRICE_TYPES = [
        self::PRICE_TYPE_DEFAULT => 'Use Product Price',
        self::PRICE_TYPE_OVERRIDE => 'Custom Price',
        self::PRICE_TYPE_ADJUSTMENT => 'Price Adjustment (+/-)',
        self::PRICE_TYPE_FREE => 'Free (Included)',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'is_selectable' => 'boolean',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * The bundle/set this item belongs to
     */
    public function bundleProduct()
    {
        return $this->belongsTo(Product::class, 'bundle_product_id');
    }

    /**
     * The product that is included in the bundle
     */
    public function itemProduct()
    {
        return $this->belongsTo(Product::class, 'item_product_id');
    }

    /**
     * Calculate the effective price for this bundle item
     */
    public function getEffectivePrice($clientId = null)
    {
        $basePrice = $this->itemProduct?->getPriceForClient($clientId) ?? $this->itemProduct?->base_price ?? 0;

        switch ($this->price_type) {
            case self::PRICE_TYPE_FREE:
                return 0;
            case self::PRICE_TYPE_OVERRIDE:
                return $this->price_override ?? $basePrice;
            case self::PRICE_TYPE_ADJUSTMENT:
                return max(0, $basePrice + ($this->price_adjustment ?? 0));
            default:
                return $basePrice;
        }
    }
}
