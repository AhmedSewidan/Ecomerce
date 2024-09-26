<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Requests\EditProductInCartRequest;
use App\Http\Requests\ProductCartRequest;
use App\Http\Resources\ApiResources\OrderResource;
use App\Http\Resources\ApiResources\ProductsInCartResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class OrderController extends ApiController
{
    public function orderInCart()
    {
        $user       = JWTAuth::user();
        $order      = $user->orders()->where('status', 'in-cart')->latest()->first();

        $data       = [
            'order'     => new OrderResource( $order ),
            'products'  => ProductsInCartResource::collection( optional($order)->products ?? null )
        ];

        return $this->response( $data );
    }

    public function addTOcart( ProductCartRequest $request )
    {
        $user                 = JWTAuth::user();
        $product              = Product::find( $request->product_id );
        $order                = $user->orders()->where('status', 'in-cart')->latest()->first();

        if (!$product) {
            return $this->errorMessage('Product not found');
        }

        $order_product        = $order->products()->where('product_id', $request->product_id)->first();

        if( $order_product ){   
            $order->products()->updateExistingPivot( $product->id, [
                'price'      => $product->price,
                'quantity'   => $order_product->pivot->quantity + $request->quantity
            ] );
        }else{
            $order->products()->attach( $product->id, [
                'price'      => $product->price,
                'quantity'   => $request->quantity
            ] );
        }

        $this->updateOrderTotal( $user );

        return $this->successMessage('Product saved succsessfully');
    }

    public function editQuantity( ProductCartRequest $request )
    {
        $user                 = JWTAuth::user();
        $product              = Product::find( $request->product_id );
        $order                = $user->orders()->where('status', 'in-cart')->latest()->first();

        if (!$product) {  // this check 1% to exist
            return $this->errorMessage('Product not found');
        }
        
        if( !$order->products()->where('product_id', $request->product_id)->first() ){  // this check 1% to exist
            return $this->errorMessage('This product doesn\'t exists in cart');
        }
        
        if( $request->quantity > 0 )
        {   
            $order->products()->updateExistingPivot( $product->id, [
                'price'      => $product->price,
                'quantity'   => $request->quantity
            ] );
        }else{
            $order->products()->detach( $product->id );
        }

        $this->updateOrderTotal( $user );

        return $this->successMessage('Product saved succsessfully');
    }

    public function removeFromCart( Request $request )
    {
        $request->validate([
            'product_id'    => 'required|integer'
        ]);

        $user            = JWTAuth::user();
        $product         = Product::find( $request->product_id );
        
        if (!$product) {
            return $this->errorMessage('Product not found');
        }
        
        $order           = $user->orders()->where('status', 'in-cart')->latest()->first();
        
        if( !$order->products()->find( $product->id ) ){
            return $this->errorMessage('Error this product doesn\'t exists in cart');
        }

        $order->products()->detach( $product->id );

        return $this->successMessage('Deleted successfully');

    }

    public function clearCart()
    {
        $user            = JWTAuth::user();
        $order           = $user->orders()->where('status', 'in-cart')->latest()->first();
        
        if( !$order->products() ){
            return $this->errorMessage('No products in cart');
        }

        $order->products()->detach();
        $this->updateOrderTotal($user);

        return $this->successMessage('Cleared successfully');

    }

    public function updateOrderTotal( $user )  // Method to call in the class to update order quantity
    {
        $order      = $user->orders()->where('status', 'in-cart')->latest()->first();
        
        $total = 0;
        foreach( $order->products as $order_product ){
            $total   += $order_product->pivot->price * $order_product->pivot->quantity; 
        }

        $order->update([
            'total'     => $total,
        ]);

        return true;
    }
}
