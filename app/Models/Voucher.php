<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $table = 'vouchers';

    protected $fillable = [
        'id',
        'user_id',
        'code',
        'discount',
        'is_used',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
