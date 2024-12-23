<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Admin\Brand;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\LicenseComment;
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
        'sell',
        'description',
        'img',
        'rating',
        'type',
        'created_at',
        'updated_at',
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

    public function subOrder()
    {
        return $this->hasMany(Sub_Order::class, 'laptop_id', 'id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class, 'laptop_id', 'id');
    }

    public function license()
    {
        return $this->hasMany(LicenseComment::class, 'laptop_id', 'id');
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($laptop) {
            $laptop->wishlist()->delete();
            $laptop->cart()->delete();
            $laptop->subOrder()->delete();
            $laptop->images()->delete();
            $laptop->comment()->delete();
            $laptop->license()->delete();
        });
    }
}
