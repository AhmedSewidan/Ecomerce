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

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
  }
  
}

?>