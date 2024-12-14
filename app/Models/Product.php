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
use Spatie\Image\Manipulations;
use Illuminate\Support\Facades\Cache;


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

    protected $fillable = [
        'published',
        'featured',
        'quantity',
        'name',
        'description',
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
        $this->addMediaConversion('original')->format(Manipulations::FORMAT_WEBP)->nonQueued();
        $this->addMediaConversion('thumb')->format(Manipulations::FORMAT_WEBP)->width(150)->height(150)->nonQueued();
        $this->addMediaConversion('preview')->format(Manipulations::FORMAT_WEBP)->width(120)->height(120)->nonQueued();
        $this->addMediaConversion('additional')->crop('crop-center', 500, 500)->format(Manipulations::FORMAT_WEBP)->nonQueued();
        $this->addMediaConversion('product')->crop('crop-center', 600, 600)->format(Manipulations::FORMAT_WEBP)->nonQueued();
        $this->addMediaConversion('featured')->crop('crop-center', 120, 120)->format(Manipulations::FORMAT_WEBP)->nonQueued();
        $this->addMediaConversion('responsive')->crop('crop-center', 470, 730)->format(Manipulations::FORMAT_WEBP)->withResponsiveImages()->nonQueued();
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
            $file->url = $file->getUrl();
            $file->original = $file->getUrl('original');
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview = $file->getUrl('preview');
            $file->additional = $file->getUrl('additional');
            $file->product = $file->getUrl('product');
            $file->featured = $file->getUrl('featured');
            $file->responsive = $file->getUrl('responsive');
        }

        return $file;
    }

//    public function getPhotoAttribute()
//    {
//        return Cache::remember("product_{$this->id}_photo", now()->addMinutes(10), function () {
//            $file = $this->getMedia('photo')->last();
//            if ($file) {
//                $file->url = $file->getUrl();
//                $file->original = $file->getUrl('original');
//                $file->thumbnail = $file->getUrl('thumb');
//                $file->preview = $file->getUrl('preview');
//                $file->additional = $file->getUrl('additional');
//                $file->product = $file->getUrl('product');
//                $file->featured = $file->getUrl('featured');
//                $file->responsive = $file->getUrl('responsive');
//            }
//
//            return $file;
//        });
//    }

    public function getAdditionalPhotosAttribute()
    {
        $files = $this->getMedia('additional_photos');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
            $item->additional = $item->getUrl('additional');
            $item->responsive = $item->getUrl('responsive');
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

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
