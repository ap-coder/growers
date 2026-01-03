<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ProductCollection extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'product_collections';

    public const LAYOUT_GRID = 'grid';
    public const LAYOUT_MASONRY = 'masonry';
    public const LAYOUT_CAROUSEL = 'carousel';
    public const LAYOUT_TILES = 'tiles';
    public const LAYOUT_COBBLE_1 = 'cobble-1';
    public const LAYOUT_COBBLE_2 = 'cobble-2';
    public const LAYOUT_COLLAGE_1 = 'collage-1';
    public const LAYOUT_COLLAGE_2 = 'collage-2';
    public const LAYOUT_FILM_STRIP = 'film-strip';
    public const LAYOUT_SPLIT_SLIDER = 'split-slider';
    public const LAYOUT_THUMBS_SLIDER = 'thumbs-slider';

    public const LAYOUT_SELECT = [
        self::LAYOUT_GRID => 'Grid',
        self::LAYOUT_MASONRY => 'Masonry Grid',
        self::LAYOUT_CAROUSEL => 'Carousel Showcase',
        self::LAYOUT_TILES => 'Tiles',
        self::LAYOUT_COBBLE_1 => 'Cobble Style 1',
        self::LAYOUT_COBBLE_2 => 'Cobble Style 2',
        self::LAYOUT_COLLAGE_1 => 'Collage Style 1',
        self::LAYOUT_COLLAGE_2 => 'Collage Style 2',
        self::LAYOUT_FILM_STRIP => 'Film Strip',
        self::LAYOUT_SPLIT_SLIDER => 'Split Slider',
        self::LAYOUT_THUMBS_SLIDER => 'Thumbs Slider',
    ];

    public const LAYOUT_ICONS = [
        self::LAYOUT_GRID => 'masonry-grid.svg',
        self::LAYOUT_MASONRY => 'masonry-grid.svg',
        self::LAYOUT_CAROUSEL => 'carousel-showcase.svg',
        self::LAYOUT_TILES => 'portfolio-tiles.svg',
        self::LAYOUT_COBBLE_1 => 'cobble-style-1.svg',
        self::LAYOUT_COBBLE_2 => 'cobble-style-2.svg',
        self::LAYOUT_COLLAGE_1 => 'collage-style-1.svg',
        self::LAYOUT_COLLAGE_2 => 'collage-style-2.svg',
        self::LAYOUT_FILM_STRIP => 'portfolio-film-strip.svg',
        self::LAYOUT_SPLIT_SLIDER => 'portfolio-split-slider.svg',
        self::LAYOUT_THUMBS_SLIDER => 'portfolio-thumbs-slider.svg',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'slug',
        'description',
        'layout_type',
        'published',
        'show_on_homepage',
        'sort_order',
        'background_color',
        'text_color',
        'columns',
        'is_fake',
    ];

    protected $casts = [
        'published' => 'boolean',
        'show_on_homepage' => 'boolean',
        'is_fake' => 'boolean',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($collection) {
            if (empty($collection->slug)) {
                $collection->slug = Str::slug($collection->name);
            }
        });
    }

    public function items()
    {
        return $this->hasMany(ProductCollectionItem::class)->orderBy('sort_order');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_collection_items')
            ->withPivot(['sort_order', 'is_featured'])
            ->withTimestamps()
            ->orderBy('product_collection_items.sort_order');
    }

    public function featuredProducts()
    {
        return $this->belongsToMany(Product::class, 'product_collection_items')
            ->withPivot(['sort_order', 'is_featured'])
            ->wherePivot('is_featured', true)
            ->orderBy('product_collection_items.sort_order');
    }

    public function getLayoutIconAttribute()
    {
        return self::LAYOUT_ICONS[$this->layout_type] ?? 'masonry-grid.svg';
    }

    public function getLayoutNameAttribute()
    {
        return self::LAYOUT_SELECT[$this->layout_type] ?? 'Grid';
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeHomepage($query)
    {
        return $query->where('show_on_homepage', true);
    }
}
