<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accessory extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'accessories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'accessory_type_id',
        'name',
        'description',
        'sku',
        'base_price',
        'published',
        'sort_order',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function accessoryType()
    {
        return $this->belongsTo(AccessoryType::class, 'accessory_type_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_accessory')
            ->withPivot(['is_default', 'is_required'])
            ->withTimestamps();
    }

    public function clientPrices()
    {
        return $this->hasMany(AccessoryClientPrice::class, 'accessory_id');
    }

    /**
     * Get the price for a specific client, or fall back to base_price
     */
    public function getPriceForClient($clientId)
    {
        $clientPrice = $this->clientPrices()->where('client_id', $clientId)->first();
        return $clientPrice ? $clientPrice->price : $this->base_price;
    }
}
