<?php 

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\ApiControllers\ApiController;
use App\Http\Resources\ApiResources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends ApiController 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index( Request $request )
  {
    
    $products = Product::when($request->has('category_id'), function($query) use($request){
      $query->where('category_id', $request->category_id);
    } )->get();
    return $this->response( ProductResource::collection($products) );
  }
  
  public function latestProducts()
  {
    $products = Product::latestProducts()->get();
    return $this->response( ProductResource::collection( $products ) );
  }
  
  public function mostOrdered()
  {
    $products = Product::mostOrdered()->limit(5)->get();
    return $this->response( ProductResource::collection($products) );
  }

  public function show($id)
  {
    return $this->response( new ProductResource( Product::findOrFail( $id ) ) );
  }

}

?>