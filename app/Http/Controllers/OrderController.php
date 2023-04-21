<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

class OrderController extends Controller
{
    /**
     * Summary of create
     * @return RedirectResponse
     */
    public static function create(): RedirectResponse {
        $cartItems = CartItem::where('user_id', Auth::id())->get();

        $order = new Order();
        $order->user_id = Auth::id();
        $order->total_price = 0;
        $order->status = 'Оформлен';
        foreach ($cartItems as $cartItem) $order->total_price += $cartItem->price * $cartItem->quantity;
        
        foreach ($cartItems as $cartItem) {
            $orderItem = new OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->user_id = Auth::id();
            $orderItem->film_id = $cartItem->film_id;
            $orderItem->quantity = $cartItem->quantity;
            $orderItem->price = $cartItem->price;
            $orderItem->save();
        }
        
        $order->save();
        
        return redirect()->route('home');
    }

    public static function update(Request $request): RedirectResponse {

    }
}
