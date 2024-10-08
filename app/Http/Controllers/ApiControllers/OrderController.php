<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Requests\ProductCartRequest;
use App\Http\Resources\ApiResources\AddressResource;
use App\Http\Resources\ApiResources\OrderAddressResource;
use App\Http\Resources\ApiResources\OrderResource;
use App\Http\Resources\ApiResources\ProductsInOrderResource;
use App\Mail\OrderDelivery;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\Product;
use App\Traits\OrderTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;

class OrderController extends ApiController
{
    use OrderTrait;

    public function orderInCart()
    {
        $user       = JWTAuth::user();
        $order      = Order::where('client_id', $user->id)->orderInCart()->latest()->first();
        
        if (!$order) {
            $this->createOrder($user->id);
        }

        $data       = [
            'order'     => new OrderResource( $order ),
            'products'  => ProductsInOrderResource::collection( $order->products )
        ];

        return $this->response( $data );
    }

    public function addTOcart( ProductCartRequest $request )
    {
        if ( !$product = Product::find( $request->product_id ) ) {
            return $this->errorMessage('Product not found', 404);
        }

        $user                 = JWTAuth::user();
        $order                = Order::where('client_id', $user->id)->orderInCart()->latest()->first();

        if (!$order) {
            $this->createOrder($user->id);
        }

        $productInPivot        = $order->products()->where('product_id', $request->product_id)->first();

        if( $productInPivot ){   
            $order->products()->updateExistingPivot( $product->id, [
                'quantity'   => $productInPivot->pivot->quantity + $request->quantity
            ] );
        }else{
            $order->products()->attach( $product->id, [
                'price'      => $product->price,
                'quantity'   => $request->quantity
            ] );
        }
        
        $this->updateOrderTotal( $order );

        return $this->successMessage('Product saved succsessfully');
    }

    public function editQuantity( ProductCartRequest $request )
    {
        if ( !$product = Product::find( $request->product_id ) ) {
            return $this->errorMessage('Product not found', 404);
        }

        $user                 = JWTAuth::user();
        $order                = Order::where('client_id', $user->id)->orderInCart()->latest()->first();
        
        if( !$order->products()->where('product_id', $request->product_id)->first() ){  // this check 1% to exist
            return $this->errorMessage('This product doesn\'t exists in cart');
        }
        
        if( $request->quantity > 0 ){   
            $order->products()->updateExistingPivot( $product->id, [
                'quantity'   => $request->quantity
            ] );
        }else{
            $order->products()->detach( $product->id );
        }

        $this->updateOrderTotal( $order );

        return $this->successMessage('Product saved succsessfully');
    }

    public function removeFromCart( string $id )
    {
        $user            = JWTAuth::user();
        $product         = Product::find( $id );
        
        if (!$product) {
            return $this->errorMessage('Product not found');
        }
        
        $order           = Order::where('client_id', $user->id)->orderInCart()->latest()->first();
        
        if( !$order->products()->find( $product->id ) ){
            return $this->errorMessage('Error this product doesn\'t exists in cart');
        }

        $order->products()->detach( $product->id );
        $this->updateOrderTotal($order);

        return $this->successMessage('Deleted successfully');

    }

    public function clearCart()
    {
        $user            = JWTAuth::user();
        $order           = Order::where('client_id', $user->id)->orderInCart()->latest()->first();

        $order->products()->detach();
        $this->updateOrderTotal( $order );

        return $this->successMessage('Cleared successfully');

    }

    public function orderDetails()
    {
        $user       = JWTAuth::user();
        $order      = Order::where('client_id', $user->id)->orderInCart()->latest()->first();
        
        if (!$order) {
            $this->createOrder($user->id);
        }
        
        // $address    = $order->address ? $order->address : $user->addresses()->where('default', 1)->first();
        
        $data       = [
            'order'       => new OrderResource( $order ),
            'products'    => ProductsInOrderResource::collection( $order->products ),
            'addresses'   => AddressResource::collection($user->addresses)
        ];

        return $this->response( $data );
    }

    public function checkout( Request $request )
    {
        $request->validate([
            'address_id'     => 'required|integer',
            'pay_method'     => 'required|string|in:vodafone-cash,vesa,paypal,upon-delivary',
            'comment'        => 'sometimes|string|max:300'
        ]);  

        if( $request->pay_method !== 'upon-delivary' ){
            return $this->errorMessage('Sorry this method isn\'t available at this time');
        }

        $user                = JWTAuth::user();
        $order               = Order::where('client_id', $user->id)->orderInCart()->latest()->first();

        if( !$addressToCopy  = $user->addresses()->find($request->address_id) ){
            return $this->errorMessage( 'Address not found', 404);
        }

        $orderAddress = OrderAddress::create( $addressToCopy->only(['city_id', 'client_id', 'title', 'address_line']) );
        
        $updateOrderData           = [
            'order_address_id' => $orderAddress->id,
            'pay'              => $request->pay_method,
            'status'           => 'pending',
        ];

        if( $request->has('comment') ){
            $updateOrderData['comment'] = $request->comment;
        }
        
        $order->update( $updateOrderData );

        $this->createOrder($user->id);

        $mailData       = [
            'username'      => strtok(  $user->name, ' ' ),
            'order_code'    => $order->code
        ];

        try{
            Mail::to($user)->send(new OrderDelivery( $mailData ));
        } catch ( \Exception $e ){
            return $this->errorMessage( $e->getMessage() );
        }
        
        return $this->response( new OrderResource($order), 'Your Order is now pending' );

    }

}
