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
    return $this->response( ProductResource::collection($products) );
  }
  
  public function mostOrdered()
  {
    $products = Product::mostOrdered()->limit(5)->get();
    return $this->response( ProductResource::collection($products) );
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
    return $this->response( new ProductResource( Product::find( $id ) ) );
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