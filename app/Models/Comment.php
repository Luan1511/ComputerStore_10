<?php

namespace App\Models;

use App\Models\Admin\Laptop;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'customer_id',
        'laptop_id',
        'content',
        'video',
        'image',
        'rating',
        'created_at',
        'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function laptop(){
        return $this->belongsTo(Laptop::class, 'laptop_id', 'id');
    }
}
