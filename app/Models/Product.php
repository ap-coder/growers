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

    public const LAYOUT_SELECT = [
        'default' => 'Default',
        'thumbnail' => 'Thumbnail',
        'grid-media' => 'Grid Media',
        'carousel' => 'Carousel',
        'full-width' => 'Full Width',
    ];

    protected $fillable = [
        'published',
        'featured',
        'is_fake',
        'layout',
        'quantity',
        'name',
        'product_type',
        'accessory_type_id',
        'sort_order',
        'description',
        'excerpt',
        'base_price',
        'full_price',
        'show_original_price',
        'show_variations',
        'show_sets',
        'show_accessories',
        'base_cost',
        'bundle_price_type',
        'bundle_price_override',
        'bundle_discount',
        'sku',
        'upc_code',
        'qb_1',
        'qb_2',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public const BUNDLE_PRICE_CALCULATED = 'calculated';
    public const BUNDLE_PRICE_FIXED = 'fixed';
    public const BUNDLE_PRICE_DISCOUNT_PERCENT = 'discount_percent';
    public const BUNDLE_PRICE_DISCOUNT_AMOUNT = 'discount_amount';

    public const BUNDLE_PRICE_TYPES = [
        self::BUNDLE_PRICE_CALCULATED => 'Sum of Items (Calculated)',
        self::BUNDLE_PRICE_FIXED => 'Fixed Bundle Price',
        self::BUNDLE_PRICE_DISCOUNT_PERCENT => 'Discount % off Calculated',
        self::BUNDLE_PRICE_DISCOUNT_AMOUNT => 'Discount $ off Calculated',
    ];

    protected $with = ['categories', 'clients', 'clientPrices'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit('crop', 50, 50)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('preview')
            ->fit('crop', 120, 120)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('shop-card')
            ->fit('crop', 300, 300)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('shop-card-sm')
            ->fit('crop', 200, 200)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('product-main')
            ->fit('contain', 600, 600)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('product-thumb')
            ->fit('crop', 100, 100)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('featured')
            ->fit('crop', 80, 80)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('cart')
            ->fit('crop', 60, 60)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('full')
            ->fit('contain', 1200, 1200)
            ->format('webp')
            ->nonQueued();

        // Collection/Portfolio sizes
        $this->addMediaConversion('large')
            ->fit('contain', 800, 600)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('portfolio')
            ->fit('crop', 600, 400)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('portfolio-square')
            ->fit('crop', 500, 500)
            ->format('webp')
            ->nonQueued();
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
            $file->url          = $file->getUrl();
            $file->thumbnail    = $file->getUrl('thumb');
            $file->preview      = $file->getUrl('preview');
            $file->shop_card    = $file->getUrl('shop-card');
            $file->shop_card_sm = $file->getUrl('shop-card-sm');
            $file->product_main = $file->getUrl('product-main');
            $file->product_thumb = $file->getUrl('product-thumb');
            $file->featured     = $file->getUrl('featured');
            $file->cart         = $file->getUrl('cart');
            $file->full         = $file->getUrl('full');
        }

        return $file;
    }

    public function getAdditionalPhotosAttribute()
    {
        $files = $this->getMedia('additional_photos');
        $files->each(function ($item) {
            $item->url          = $item->getUrl();
            $item->thumbnail    = $item->getUrl('thumb');
            $item->preview      = $item->getUrl('preview');
            $item->shop_card    = $item->getUrl('shop-card');
            $item->shop_card_sm = $item->getUrl('shop-card-sm');
            $item->product_main = $item->getUrl('product-main');
            $item->product_thumb = $item->getUrl('product-thumb');
            $item->featured     = $item->getUrl('featured');
            $item->cart         = $item->getUrl('cart');
            $item->full         = $item->getUrl('full');
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

    public function priceTiers()
    {
        return $this->hasMany(ProductPriceTier::class)->orderBy('min_quantity');
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class)->orderBy('sort_order');
    }

    public function hasVariations()
    {
        return $this->variations()->exists();
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
            ->withPivot(['is_default', 'is_required', 'included_in_price'])
            ->withTimestamps();
    }

    public function getAccessoriesByType()
    {
        return $this->accessories()
            ->with('accessoryType')
            ->get()
            ->groupBy(function ($accessory) {
                return $accessory->accessoryType->name ?? 'Other';
            });
    }

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

    public function getPriceForQuantity($quantity, $clientId = null)
    {
        $tier = $this->priceTiers()
            ->where('min_quantity', '<=', $quantity)
            ->where(function ($query) use ($quantity) {
                $query->whereNull('max_quantity')
                      ->orWhere('max_quantity', '>=', $quantity);
            })
            ->orderBy('min_quantity', 'desc')
            ->first();

        if ($tier) {
            return $tier->price;
        }

        return $this->getPriceForClient($clientId);
    }

    public function hasPriceTiers()
    {
        return $this->priceTiers()->exists();
    }

    public function hasClientPrice($clientId)
    {
        return $this->clientPrices()->where('client_id', $clientId)->exists();
    }

    public function accessoryType()
    {
        return $this->belongsTo(AccessoryType::class, 'accessory_type_id');
    }

    public function bundleItems()
    {
        return $this->hasMany(ProductBundleItem::class, 'bundle_product_id');
    }

    public function getBundleItemsByGroup()
    {
        return $this->bundleItems()
            ->with('itemProduct')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('group_name');
    }

    public function includedInBundles()
    {
        return $this->hasMany(ProductBundleItem::class, 'item_product_id');
    }

    public function scopeStandard($query)
    {
        return $query->where('product_type', self::TYPE_STANDARD);
    }

    public function scopeAccessories($query)
    {
        return $query->where('product_type', self::TYPE_ACCESSORY);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeSets($query)
    {
        return $query->where('product_type', self::TYPE_SET);
    }

    public function isAccessory()
    {
        return $this->product_type === self::TYPE_ACCESSORY;
    }

    public function isSet()
    {
        return $this->product_type === self::TYPE_SET;
    }

    public function calculateBundlePrice($clientId = null)
    {
        if (!$this->isSet()) {
            return $this->getPriceForClient($clientId);
        }

        $calculatedTotal = 0;
        foreach ($this->bundleItems as $item) {
            $calculatedTotal += $item->getEffectivePrice($clientId) * $item->quantity;
        }

        switch ($this->bundle_price_type) {
            case self::BUNDLE_PRICE_FIXED:
                return $this->bundle_price_override ?? $calculatedTotal;

            case self::BUNDLE_PRICE_DISCOUNT_PERCENT:
                $discount = ($this->bundle_discount ?? 0) / 100;
                return $calculatedTotal * (1 - $discount);

            case self::BUNDLE_PRICE_DISCOUNT_AMOUNT:
                return max(0, $calculatedTotal - ($this->bundle_discount ?? 0));

            case self::BUNDLE_PRICE_CALCULATED:
            default:
                return $calculatedTotal;
        }
    }

    public function getBundleSavings($clientId = null)
    {
        if (!$this->isSet()) {
            return 0;
        }

        $fullPrice = 0;
        foreach ($this->bundleItems as $item) {
            $itemProduct = $item->itemProduct;
            if ($itemProduct) {
                $fullPrice += ($itemProduct->getPriceForClient($clientId) ?? $itemProduct->base_price ?? 0) * $item->quantity;
            }
        }

        $bundlePrice = $this->calculateBundlePrice($clientId);
        return max(0, $fullPrice - $bundlePrice);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'product_favorites')->withTimestamps();
    }

    public function isFavoritedBy($user)
    {
        if (!$user) {
            return false;
        }
        return $this->favoritedBy()->where('user_id', $user->id)->exists();
    }
}
