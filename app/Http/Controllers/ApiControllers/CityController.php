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
      
    } )->get(['id', 'title']);

    return $this->response( CityResource::collection($cities) );
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