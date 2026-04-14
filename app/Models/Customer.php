<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'city',
        'google_id',
        'role', // user/admin
        'avatar',
        'email_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Un client a plusieurs commandes
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Vérifier si admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
     
}