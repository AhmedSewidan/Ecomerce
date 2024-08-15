<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model 
{

    use HasFactory;
    
    protected $table = 'reviews';
    public $timestamps = true;
    protected $fillable = array('body', 'stars');

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}