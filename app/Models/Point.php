<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    // use HasFactory;
    protected $table = 'pointer'; 
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'point',    
    ];

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }
}
