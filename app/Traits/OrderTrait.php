<?php

namespace App\Traits;

use App\Models\Order;

trait OrderTrait
{
    public function createOrder( $user_id )
    {
        return Order::create([
            'client_id'     => $user_id,
            'code'          => Order::generateUniqueCode(),
            'expires_at'    => Order::expiresAtTime()
        ]);
    }

    public function updateOrderTotal( $order )
    {
        $total = 0;
        foreach( $order->products as $productInPivot ){
            $total   += $productInPivot->pivot->price * $productInPivot->pivot->quantity; 
        }

        $order->update([
            'total'     => $total,
        ]);

        return true;
    }
}
