<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_Order extends Model
{
    use HasFactory;
    protected $table = 'sub_orders';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'main_order_id',
        'laptop_id',
        'quantity',
        'laptop_price',
        'total_laptop_price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'main_order_id', 'id');
    }

    public function laptop()
    {
        return $this->belongsTo(Laptop::class, 'laptop_id', 'id');
    }
}
