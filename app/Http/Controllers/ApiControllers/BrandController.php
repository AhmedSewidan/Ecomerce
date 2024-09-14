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
        return $this->response( BrandResource::collection( Brand::all() ) );
    }
    
    public function mostFamousBrands()
    {
        return $this->response( BrandResource::collection( Brand::mostFamous()->get() ) );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $brand = Brand::findOrFail( $request->brand_id );
        return $this->response( [
                'brand'          =>  new BrandResource( $brand ),
                'products'       =>  ProductResource::collection( $brand->products ),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
