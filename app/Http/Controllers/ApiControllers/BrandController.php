<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResources\BrandResource;
use App\Http\Resources\ApiResources\ProductResource;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class BrandController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BrandResource::collection( Brand::paginate(2) );
    }
    
    public function mostFamousBrands()
    {
        return $this->response( BrandResource::collection( Brand::mostFamous()->get() ) );
    }

    public function show(Request $request)
    {
        $brand = Brand::findOrFail( $request->brand_id );
        return $this->response( [
                'brand'          =>  new BrandResource( $brand ),
                'products'       =>  ProductResource::collection( $brand->products ),
            ]);
    }
}
