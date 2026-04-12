<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{    
    use HasFactory;
    protected $fillable = ['name','description','price','stock','image','category_id'];

    // Appartient à une catégorie
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Plusieurs commandes (Many-to-Many via order_items)
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items')
                    ->withPivot('quantity','price');
    }
    public function getNameAttribute($value)
{
    return strtoupper($value);
} public function setNameAttribute($value)
{
    $this->attributes['name'] = strtolower($value);
}
protected $casts = [
    'price' => 'float',
];
}