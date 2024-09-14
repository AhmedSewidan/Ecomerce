<?php 

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\ApiControllers\ApiController;
use App\Http\Resources\ApiResources\CityResource;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends ApiController 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index( Request $request )
  {
    $cities = City::when($request->has('governorate_id'), function($query) use($request){

      $query->where('governorate_id', $request->governorate_id);
      
    } )->get(['id', 'governorate_id', 'title']);

    return $this->response( CityResource::collection($cities) );
  }

}

?>