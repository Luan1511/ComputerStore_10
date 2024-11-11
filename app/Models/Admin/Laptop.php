<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Admin\Brand;

class Laptop extends Model
{
    // use HasFactory;
    protected $table = 'laptops';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'name',
        'brand_id',
        'processor',
        'ram',
        'rom',
        'screen_size',
        'graphics_card',
        'battery',
        'os',
        'price',
        'stock',
        'description',
        'created_at',
        'updated_at',
        'img',
        'rating'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(Images_Laptop::class);
    }
}
