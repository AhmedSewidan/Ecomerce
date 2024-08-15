<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model 
{
<<<<<<< HEAD

    use HasFactory;
    
=======
>>>>>>> 88b59fffecc57da7a36944e1c00996fce5555674
    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = array('title', 'photo');

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}