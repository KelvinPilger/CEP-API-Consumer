<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddressData extends Model
{
    protected $table = 'address_data';

    use SoftDeletes;

    protected $fillable = [
        'cep',
        'state',
        'city',
        'neighborhood',
        'street',
        'service',
    ];

       protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function location() {
        return $this->hasOne(Location::class, 'address_id');
    }
}

