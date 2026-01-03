<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'location';

    protected $fillable = [
        'address_id',
        'type',
        'longitude',
        'latitude',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function addressData() {
        return $this->belongsTo(AddressData::class, 'address_id');
    }
}
