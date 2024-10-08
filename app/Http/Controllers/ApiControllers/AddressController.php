<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Resources\ApiResources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AddressController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user            = JWTAuth::user();
        return $this->response( AddressResource::collection( $user->addresses ) );
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data            = $request->validate([
            'city_id'        => 'required|integer',
            'address_line'   => 'required|string|max:255|min:5',
            'title'          => 'required|string|max:50|min:3',
            'default'        => 'sometimes|boolean'
        ]);

        $user            = JWTAuth::user();

        if( $request->has('default') ){
            $user->addresses()->update(['default' => 0]);
        }

        $data['client_id'] = $user->id;

        if( !$user->addresses()->where('default', 1)->first() ){
            $data['default'] = 1;
        }
        
        $address         = Address::create( $data );  

        return $this->successMessage('Address added successfully');
    }

    /**
     * Show 
     */
    public function show(string $id)
    {
        if( !$address = Address::find($id) ){
            return $this->errorMessage('Address not found', 404);
        }

        return $this->response( new AddressResource( $address ) );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'city_id'        => 'sometimes|integer',
            'address_line'   => 'sometimes|string|max:255|min:5',
            'title'          => 'sometimes|string|max:50|min:3',
            'default'        => 'sometimes|boolean'
        ]);

        $user   = JWTAuth::user();

        if( !$address = Address::find($id) ){
            return $this->errorMessage('Address not found', 404);
        }

        if( $request->has('default') ){
            $user->addresses()->update(['default' => 0]);
        }
        
        $address->update( $data );  

        return $this->successMessage('Address updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if( !$address = Address::find($id) ){
            return $this->errorMessage('Address not found', 404);
        }

        $user   = JWTAuth::user();
        
        try{
            $address::find($id)->delete();
        } catch ( \Exception $e ){
            return $this->errorMessage('Can\'t delete this address');
        }
        
        if( !$user->addresses()->where('default', 1)->first() 
            && $randAddress = $user->addresses()->first() ){

            $randAddress->update(['default' =>  1]);
        }

        return $this->successMessage('Address deleted successfully');
    }

    // public function addressInOrder()
    // {
    //     $user            = JWTAuth::user();
    //     $order           = $user->orders()->where('status', 'in-cart')->latest()->first();
        
    //     if (!$order) {
    //         return $this->errorMessage( 'No order found in cart.', 404);
    //     } 

    //     $addresses = $user->addresses->map(function ($address) use ($order) {
    //         $address->default = $address->id == $order->address_id ? 1 : 0;
    //         return $address;
    //     });

    //     return $this->response( AddressResource::collection( $addresses ) );
    // }
}
