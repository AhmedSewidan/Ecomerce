<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\CategoryResouce;
use App\Models\Category;

class CategoryController extends ApiController
{
    public function getCategories(){
        
        $categories = Category::get();
        
        return $this->response(CategoryResouce::collection($categories));
    }
}
