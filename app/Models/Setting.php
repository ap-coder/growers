<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Setting extends Model implements HasMedia
{
    use SoftDeletes, HasFactory, InteractsWithMedia;

    public $table = 'settings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const TYPE_SELECT = [
        'text' => 'Text',
        'textarea' => 'Textarea',
        'html' => 'HTML (WYSIWYG)',
        'image' => 'Image',
        'boolean' => 'Boolean',
        'select' => 'Select',
    ];

    public const GROUP_SELECT = [
        'general' => 'General',
        'login' => 'Login Page',
        'branding' => 'Branding',
        'contact' => 'Contact Info',
        'shop' => 'Shop Settings',
    ];

    public const SHOP_LAYOUT_SELECT = [
        'standard' => 'Shop Standard',
        'list' => 'Shop List',
        'with-category' => 'Shop With Category',
        'filters-top-bar' => 'Shop Filters Top Bar',
        'sidebar' => 'Shop Sidebar',
        'style-1' => 'Shop Style 1',
        'style-2' => 'Shop Style 2',
    ];

    public const SHOP_DEFAULT_VIEW_SELECT = [
        'grid-small' => 'Small Grid (4 columns)',
        'grid-large' => 'Large Grid (2 columns)',
        'list' => 'List View',
    ];

    public const PRODUCT_LAYOUT_SELECT = [
        'default' => 'Default',
        'thumbnail' => 'Thumbnail',
        'grid-media' => 'Grid Media',
        'carousel' => 'Carousel',
        'full-width' => 'Full Width',
    ];

    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function set($key, $value, $type = 'text', $group = 'general', $label = null, $description = null)
    {
        return static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'group' => $group,
                'label' => $label,
                'description' => $description,
            ]
        );
    }

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

        $this->addMediaConversion('login-bg')
            ->fit('contain', 1920, 1080)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('full')
            ->fit('contain', 2560, 1440)
            ->format('webp')
            ->nonQueued();
    }

    public function getImageAttribute()
    {
        $file = $this->getMedia('image')->last();
        if ($file) {
            $file->url = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview = $file->getUrl('preview');
            $file->login_bg = $file->getUrl('login-bg');
            $file->full = $file->getUrl('full');
        }

        return $file;
    }
}
