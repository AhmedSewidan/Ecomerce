<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model 
{

    use HasFactory;
    
    protected $table = 'product_photos';
    public $timestamps = true;
    protected $fillable = array('photo');

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}