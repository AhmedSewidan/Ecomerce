<?php 

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\ApiControllers\ApiController;
use App\Http\Resources\ApiResources\CountryResource;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends ApiController 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    return CountryResource::collection( Country::paginate(5) );
  }
  
}

?>