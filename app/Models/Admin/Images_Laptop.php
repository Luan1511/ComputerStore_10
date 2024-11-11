<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images_Laptop extends Model
{
    // use HasFactory;
    protected $table = 'images_laptop';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'image_url',
        'id_laptop',
    ];

    public function iamges_laptop()
    {
        return $this->belongsTo(Laptop::class);
    }
}
