<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model 
{

    use HasFactory;
    
    protected $table = 'addresses';
    public $timestamps = true;
    protected $fillable = array('city_id', 'client_id', 'address_line', 'default', 'title');

    // Scopes
    public function scopeDefaultAddress($query)
    {
        return $query->where('default', 1);
    }

    // Relations
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}