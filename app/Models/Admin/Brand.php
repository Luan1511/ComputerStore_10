<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands'; 
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',   
        'name',
        'image',
    ];

    public function laptops() {
        return $this->hasMany(Laptop::class, 'brand_id', 'id');
    }

    protected static function booted()
    {
        static::addGlobalScope('countBrand', function ($query) { 
            // $query->where('is_read', 0);
        });
    }
}
