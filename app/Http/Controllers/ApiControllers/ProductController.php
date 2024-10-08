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
    } )->ProductsShown()->get();
    return $this->response( ProductResource::collection($products) );
  }
  
  public function latestProducts()
  {
    return ProductResource::collection(  Product::latestProducts()->paginate(5) );
  }
  
  public function mostOrdered()
  {
    return ProductResource::collection( Product::mostOrdered()->paginate(5) );
  }

  public function show($id)
  {
    return $this->response( new ProductResource( Product::findOrFail( $id ) ) );
  }

}

?>