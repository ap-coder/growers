<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCollectionItem extends Model
{
    use HasFactory;

    public $table = 'product_collection_items';

    protected $fillable = [
        'product_collection_id',
        'product_id',
        'sort_order',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function collection()
    {
        return $this->belongsTo(ProductCollection::class, 'product_collection_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
