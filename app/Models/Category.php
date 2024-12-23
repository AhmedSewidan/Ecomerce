<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model 
{

    use HasFactory;
    
    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = array('title', 'photo');

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    public function slider()
    {
        return $this->morphOne(Slider::class, 'slidable');
    }
}