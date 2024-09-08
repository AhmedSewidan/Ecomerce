<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model 
{
    use HasFactory;

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('photo', 'title', 'price', 'quantity', 'description', 'status');

    // Get Methods
    public function getAmountAfterDiscount()
    {
        return $this->discount ? ($this->price * $this->discount) : $this->price;
    }

    // Scopes 
    public function scopeLatestProducts( $query )
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Relations
    public function photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id' );
    }
    
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id' );
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function slider()
    {
        return $this->morphOne(Slider::class, 'slidable');
    }

}