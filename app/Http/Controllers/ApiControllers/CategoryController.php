<?php 

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\ApiControllers\ApiController;
use App\Http\Resources\ApiResources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      return CategoryResource::collection( Category::paginate(3) );
  }

  public function show($id)
  {
    return $this->response( new CategoryResource( Category::findOrFail( $id ) ) );
  }

}

?>