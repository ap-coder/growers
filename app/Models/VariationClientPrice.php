<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VariationClientPrice extends Model
{
    public $table = 'variation_client_prices';

    protected $fillable = [
        'variation_id',
        'client_id',
        'price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function variation()
    {
        return $this->belongsTo(ProductVariation::class, 'variation_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
