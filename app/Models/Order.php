<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Facades\JWTAuth;

class Order extends Model 
{

    use HasFactory;
    
    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array( 'client_id', 'address_id', 'pay', 'status', 'total');

    // Get Attribute

    // Relations
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('price', 'quantity');
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

}