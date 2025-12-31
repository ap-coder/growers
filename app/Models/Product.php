<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'products';

    protected $appends = [
        'photo',
        'additional_photos',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const TYPE_STANDARD = 'standard';
    public const TYPE_ACCESSORY = 'accessory';
    public const TYPE_SET = 'set';

    public const TYPE_SELECT = [
        'standard' => 'Standard Product',
        'accessory' => 'Accessory',
        'set' => 'Set/Bundle',
    ];

    protected $fillable = [
        'published',
        'featured',
        'quantity',
        'name',
        'product_type',
        'accessory_type_id',
        'sort_order',
        'description',
        'base_price',
        'sku',
        'upc_code',
        'qb_1',
        'qb_2',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected $with = ['categories', 'clients', 'clientPrices'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class);
    }

    public function tags()
    {
        return $this->belongsToMany(ProductTag::class);
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getAdditionalPhotosAttribute()
    {
        $files = $this->getMedia('additional_photos');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_product');
    }

    public function clientPrices()
    {
        return $this->hasMany(ClientPrice::class, 'product_id', 'id');
    }

    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery($excludeDeleted)->with(['categories', 'clients', 'clientPrices']);
    }

    public function clients_prices()
    {
        return $this->belongsTo(ClientPrice::class, 'clients_prices_id');
    }
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function accessories()
    {
        return $this->belongsToMany(Accessory::class, 'product_accessory')
            ->withPivot(['is_default', 'is_required'])
            ->withTimestamps();
    }

    /**
     * Get accessories grouped by their type for display
     */
    public function getAccessoriesByType()
    {
        return $this->accessories()
            ->with('accessoryType')
            ->get()
            ->groupBy('accessory_type_id');
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

    /**
     * Check if product has a client-specific price
     */
    public function hasClientPrice($clientId)
    {
        return $this->clientPrices()->where('client_id', $clientId)->exists();
    }

    /**
     * Accessory type relationship (for accessory products)
     */
    public function accessoryType()
    {
        return $this->belongsTo(AccessoryType::class, 'accessory_type_id');
    }

    /**
     * Bundle items - products included in this set/bundle
     */
    public function bundleItems()
    {
        return $this->hasMany(ProductBundleItem::class, 'bundle_product_id');
    }

    /**
     * Get bundle items grouped by group_name for display
     */
    public function getBundleItemsByGroup()
    {
        return $this->bundleItems()
            ->with('itemProduct')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('group_name');
    }

    /**
     * Bundles this product is included in
     */
    public function includedInBundles()
    {
        return $this->hasMany(ProductBundleItem::class, 'item_product_id');
    }

    /**
     * Scope for standard products only
     */
    public function scopeStandard($query)
    {
        return $query->where('product_type', self::TYPE_STANDARD);
    }

    /**
     * Scope for accessories only
     */
    public function scopeAccessories($query)
    {
        return $query->where('product_type', self::TYPE_ACCESSORY);
    }

    /**
     * Scope for sets/bundles only
     */
    public function scopeSets($query)
    {
        return $query->where('product_type', self::TYPE_SET);
    }

    /**
     * Check if this is an accessory
     */
    public function isAccessory()
    {
        return $this->product_type === self::TYPE_ACCESSORY;
    }

    /**
     * Check if this is a set/bundle
     */
    public function isSet()
    {
        return $this->product_type === self::TYPE_SET;
    }
}
