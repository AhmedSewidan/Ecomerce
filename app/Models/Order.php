<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Facades\JWTAuth;

class Order extends Model 
{

    use HasFactory;
    
    public $timestamps = true;
    protected $fillable = array( 
        'client_id', 'code', 'order_address_id', 'pay', 'status', 'comment', 'total', 'expires_at'
        );


    // Methods
    public static function generateUniqueCode( $digits = 7 )
    {
        $randomNumber = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        
        do {
            $code = '#' . $randomNumber;
        } while ( self::where('code', $code)->exists() );

        return $code;
    }

    public static function expiresAtTime( $expiresAfter = 10 )
    {
        return now()->addDays($expiresAfter);
    }


    // Scopes
    public function scopeOrderInCart($query)
    {
        return $query->where('status', 'in-cart')->where('expires_at', '>', now());
    }


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
        return $this->belongsTo( OrderAddress::class, 'order_address_id' );
    }

}