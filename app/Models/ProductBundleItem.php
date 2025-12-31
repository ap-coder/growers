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
        'is_required',
        'is_selectable',
        'group_name',
        'sort_order',
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
}
