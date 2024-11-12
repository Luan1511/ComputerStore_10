<?php

namespace App\Models;

use App\Models\Admin\Laptop;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts'; 
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'customer_id',
        'laptop_id',
        'quantity',
    ];

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function laptop(){
        return $this->belongsTo(Laptop::class, 'laptop_id', 'id');
    }
}
