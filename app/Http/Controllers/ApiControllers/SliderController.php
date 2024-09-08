<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResources\SliderResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends ApiController
{
    public function homeSlider( Request $request )
    {

        $slider = Slider::find( $request->slidable_id );
        
        return $slider ? $this->response( $slider->slidable ) : null;
    }
}
