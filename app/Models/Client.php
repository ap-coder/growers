<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable, HasFactory;

    public $table = 'clients';

    public static $searchable = [
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function clientPrices()
    {
        return $this->hasMany(ClientPrice::class, 'client_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'client_prices', 'client_id', 'product_id')
            ->withPivot('price', 'sku', 'mpn', 'gtin', 'upc', 'qb_1', 'qb_2')
            ->withTimestamps();
    }


    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
