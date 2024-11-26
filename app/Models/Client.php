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
        'name',
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
}
