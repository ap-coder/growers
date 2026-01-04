<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientAddress extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'client_addresses';

    public const TYPE_LOCATION = 'location';
    public const TYPE_CORPORATE = 'corporate';
    public const TYPE_SHIPPING = 'shipping';
    public const TYPE_BILLING = 'billing';

    public const TYPE_SELECT = [
        self::TYPE_LOCATION => 'Location',
        self::TYPE_CORPORATE => 'Corporate / Main Office',
        self::TYPE_SHIPPING => 'Shipping / Delivery',
        self::TYPE_BILLING => 'Billing',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'client_id',
        'address_type',
        'label',
        'nickname',
        'is_primary',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'postal_code',
        'country',
        'contact_name',
        'contact_phone',
        'contact_email',
        'delivery_notes',
        'special_instructions',
        'google_map_link',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getFullAddressAttribute()
    {
        $parts = array_filter([
            $this->address_line_1,
            $this->address_line_2,
            $this->city . ', ' . $this->state . ' ' . $this->postal_code,
            $this->country !== 'USA' ? $this->country : null,
        ]);
        return implode("\n", $parts);
    }

    public function getTypeNameAttribute()
    {
        return self::TYPE_SELECT[$this->address_type] ?? $this->address_type;
    }

    public function getDisplayNameAttribute()
    {
        if ($this->label) {
            return $this->label . ' (' . $this->type_name . ')';
        }
        return $this->type_name . ($this->is_primary ? ' - Primary' : '');
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('address_type', $type);
    }

    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    public function scopeShipping($query)
    {
        return $query->where('address_type', self::TYPE_SHIPPING);
    }

    public function scopeBilling($query)
    {
        return $query->where('address_type', self::TYPE_BILLING);
    }

    public function scopeCorporate($query)
    {
        return $query->where('address_type', self::TYPE_CORPORATE);
    }

    public function scopeLocation($query)
    {
        return $query->where('address_type', self::TYPE_LOCATION);
    }
}
