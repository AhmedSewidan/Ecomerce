<?php 

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\ApiControllers\ApiController;
use App\Http\Resources\ApiResources\GovernorateResource;
use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends ApiController 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
      $governorates = Governorate::when( $request->has("country_id"), function($query) use($request){

        $query->where("country_id", $request->country_id);  

      })->get(['id', 'country_id', 'title']);
      return $this->response( GovernorateResource::collection($governorates) );
  }
  
}

?>