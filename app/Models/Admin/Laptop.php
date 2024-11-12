<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Admin\Brand;
use App\Models\Cart;
use App\Models\Wishlist;

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

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class, 'id', 'id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class, 'id', 'id');
    }
}
