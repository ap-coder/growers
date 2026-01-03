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
        'published',
        'is_fake',
        'name',
        'logo',
        'store_number',
        'contact_name',
        'contact_phone',
        'contact_email',
        'address',
        'delivery_notes',
        'how_to_order_content',
        'requires_upc',
        'created_at',
        'prices_id',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'client_product', 'client_id', 'product_id');
    }

    public function clientPrices()
    {
        return $this->hasMany(ClientPrice::class, 'client_id', 'id');
    }

    public function clientClientPrices()
    {
        return $this->hasMany(ClientPrice::class, 'client_id', 'id');
    }

    public function clientsProducts()
    {
        return $this->belongsToMany(Product::class);
    }


    public function prices()
    {
        return $this->belongsTo(ClientPrice::class, 'prices_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function addresses()
    {
        return $this->hasMany(ClientAddress::class);
    }

    public function shippingAddresses()
    {
        return $this->hasMany(ClientAddress::class)->where('address_type', ClientAddress::TYPE_SHIPPING);
    }

    public function billingAddresses()
    {
        return $this->hasMany(ClientAddress::class)->where('address_type', ClientAddress::TYPE_BILLING);
    }

    public function corporateAddresses()
    {
        return $this->hasMany(ClientAddress::class)->where('address_type', ClientAddress::TYPE_CORPORATE);
    }

    public function primaryShippingAddress()
    {
        return $this->hasOne(ClientAddress::class)
            ->where('address_type', ClientAddress::TYPE_SHIPPING)
            ->where('is_primary', true);
    }

    public function primaryBillingAddress()
    {
        return $this->hasOne(ClientAddress::class)
            ->where('address_type', ClientAddress::TYPE_BILLING)
            ->where('is_primary', true);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
