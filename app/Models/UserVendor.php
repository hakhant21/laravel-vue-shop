<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vendor_id',
        'sub_role',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function vendor()
    {
        return $this->belongsToMany(Vendor::class);
    }
}