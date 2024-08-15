<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model 
{

    use HasFactory;
    
    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('governorate_id', 'title');

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

}