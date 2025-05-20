<?php

namespace App\Models;

use Laravel\Jetstream\Team;

class Franchise extends Team
{
    protected $table = 'teams'; // Reuse Jetstream's table if needed

    protected $fillable = [
        'name',
        'business_name',
        'taxID',
        'address1',
        'address2',
        'city',
        'state',
        'zip_code',
        'territory_zip_codes',
        'stripeAPI',
        'user_id',
    ];

    protected $casts = [
        'territory_zip_codes' => 'array',
    ];
}
