<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Film;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Summary of CartController
 */
class CartController extends Controller
{

    public static function index() {
        return view('cart', ['cartItems' => CartItem::where('user_id', Auth::id())->get()]);
    }

    
    
    /**
     * Summary of cartAddOrIncrease
     * @param Request $request
     * @return RedirectResponse
     */
    public static function cartAddOrIncrease(Request $request): RedirectResponse {
        $film = Film::find($request->id);
        $cartItem = CartItem::firstOrCreate([
            'film_id' => $film->id,
            'user_id' => Auth::id(),
        ], [
            'title' =>$film->title,
            'image' => $film->image,
            'censorship' => $film->censorship,
            'price' => $film->price,
            'premiereDate' => $film->premiereDate,
            'quantity' => 1,
            'genre' => $film->genre
        ]);
        if (!$cartItem->wasRecentlyCreated) {
            $cartItem->quantity++;
            $cartItem->save();
        }
        return redirect()->route('home');
    }
    
    /**
     * Summary of cartIncrease
     * @param Request $request
     * @return RedirectResponse
     */
    public static function cartIncrease(Request $request): RedirectResponse {
        $cartItem = CartItem::firstWhere(['user_id' => Auth::id(), 'film_id' => $request->id]);
        $cartItem->quantity++;
        $cartItem->save();
        return redirect()->route('cart');
    }

    /**
     * Summary of cartRemove
     * @param Request $request
     * @return RedirectResponse
     */
    public static function cartRemove(Request $request): RedirectResponse {
        CartItem::firstWhere(['user_id' => Auth::id(), 'film_id' => $request->id])->delete();
        return redirect()->route('cart');
    }


    /**
     * Summary of cartRemoveOrDecrease
     * @param Request $request
     * @return RedirectResponse
     */
    public static function cartRemoveOrDecrease(Request $request): RedirectResponse {
        $cartItem = CartItem::firstWhere('film_id', $request->id);
        if ($cartItem->quantity == 1) {
            $cartItem->delete();
        } else {
            $cartItem->quantity--;
            $cartItem->save();
        }
        return redirect()->route('cart');
    }

    /**
     * Summary of cartClear
     * @return RedirectResponse
     */
    public static function cartClear(): RedirectResponse {
        CartItem::where('user_id', Auth::id())->delete();
        return redirect()->route('cart');
    }

}
