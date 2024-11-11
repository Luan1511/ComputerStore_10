<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands'; 
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
    ];
}
