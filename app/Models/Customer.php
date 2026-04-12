<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
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
        'avatar'=>'avatars/default.png',
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