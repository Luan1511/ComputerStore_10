<?php

namespace App\Models;

use App\Models\Admin\Laptop;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseComment extends Model
{
    // use HasFactory;
    protected $table = 'license_comment'; 
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'user_id',
        'laptop_id',
    ];

    public function user(){

        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function laptop(){
        return $this->belongsTo(Laptop::class, 'laptop_id', 'id');
    }
}
