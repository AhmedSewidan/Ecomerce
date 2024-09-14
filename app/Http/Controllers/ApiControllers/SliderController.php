<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResources\SliderResource;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends ApiController
{
    public function index()
    {
        return SliderResource::collection( Slider::paginate(2) );
    }
    public function homeSlider( Request $request )
    {
        $routeName    = Slider::getRouteBySlidableId( $request->slidable_id );

        return redirect()->route( $routeName , [ 'id' => $request->slidable_id ]);
    }
}
