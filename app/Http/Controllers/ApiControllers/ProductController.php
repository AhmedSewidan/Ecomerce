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
    } )->get(['id', 'category_id', 'title', 'price', 'quantity', 'description', 'status', 'photo']);
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