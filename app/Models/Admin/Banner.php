<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table = 'banners';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id', 'type', 'image', 'created_at', 'updated_at'];
}
