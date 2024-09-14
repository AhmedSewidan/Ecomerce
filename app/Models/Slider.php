<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
    ];

    // Methods
    public static function getRouteBySlidableId( $slidableId )
    {
        $slidableType = Slider::findOrFail( $slidableId )->slidable_type;

        return match ( $slidableType )
        {
            "App\Models\Category" => "show-category",
            "App\Models\Product" => "show-product",
            default => null,
        };
    }


    // Relations
    public function slidable()
    {
        return $this->morphTo();
    }
}
