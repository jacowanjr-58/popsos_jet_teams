<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleRequest extends Model
{
    protected $fillable = ['user_id', 'desired_role', 'franchise_ids', 'status'];
    protected $casts = [
        'franchise_ids' => 'array',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
