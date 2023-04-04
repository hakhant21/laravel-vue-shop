<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'color' => 'array',
        'size' => 'array',
    ];

    public function images()
    {
        return $this->hasMany(ImageFile::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
