<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model 
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('password', 'phone');

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

}