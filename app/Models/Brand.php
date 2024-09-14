<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    
    public $timestamps = true;
    protected $fillable = array('title', 'photo', 'web_link');


    // Scopes
    public function scopeMostFamous( $query )
    {
        return $query->where('status', 1);
    }

    // Relations
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
