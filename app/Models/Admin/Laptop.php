<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
