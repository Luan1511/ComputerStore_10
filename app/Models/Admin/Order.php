<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'customer_id',
        'name',
        'phone',
        'address',
        'status',
        'payment_method',
        'total_price',
        'created_at',
        'updated_at',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function subOrder()
    {
        return $this->hasMany(Sub_Order::class, 'main_order_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($order) {
            $order->subOrder()->delete();
        });
    }
}
