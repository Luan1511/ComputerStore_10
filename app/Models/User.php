<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Admin\AdminNotification; 
use App\Models\Admin\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'birthday',
        'address',
        'password',
        'img',
        'authority',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function wishlist(){
        return $this->hasMany(Wishlist::class, 'customer_id', 'id');
    }

    public function cart(){
        return $this->hasMany(Cart::class, 'customer_id', 'id');
    }

    public function order(){
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }
    
    public function message(){
        return $this->hasMany(Message::class, 'user_id', 'id');
    }

    public function admin(){
        return $this->hasOne(User::class, 'user_id', 'id');
    }

    public function point(){
        return $this->hasOne(Point::class, 'user_id', 'id');
    }

    public function voucher(){
        return $this->hasMany(Voucher::class, 'user_id', 'id');
    }

    public function comment(){
        return $this->hasMany(Comment::class, 'customer_id', 'id');
    }

    public function license(){
        return $this->hasMany(LicenseComment::class, 'user_id', 'id');
    }

    public function noti_sent(){
        return $this->hasMany(AdminNotification::class, 'user_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            $user->wishlist()->delete();
            $user->cart()->delete();
            $user->order()->delete();
            $user->message()->delete();
            $user->admin()->delete();
            $user->point()->delete();
            $user->voucher()->delete();
            $user->comment()->delete();
            $user->license()->delete();
            $user->noti_sent()->delete();
        });
    }

    protected static function booted()
    {
        static::addGlobalScope('countUser', function ($query) { 
            // $query->where('authority', 2);
        });
    }
}
