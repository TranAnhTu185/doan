<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use Javascript;

class CartController extends Controller
{

    public function getCart() {
        $carts = Cart::where('customer_id', Auth::guard('customer')->user()->id)->with('product', 'product.product_image')->get();
        return response()->json($carts);
    }

    public function addCart(Request $request) {
        $user = Auth::guard('customer')->user()->id;
        $productId = $request->product_id;
        $quantity = $request->quantity ? $request->quantity : 1;
        $cart = Cart::where(['customer_id' => $user, 'product_id' => $productId])->first();
        if ($cart) {
            $cart->quantity += $quantity;
            $cart->save();
        } else {
            $cart = new Cart();
            $cart->customer_id = Auth::guard('customer')->user()->id;
            $cart->quantity = $quantity;
            $cart->product_id = $productId;
            $cart->save();
        }
        return response()->json(['message' => 'add cart success'], 200);
    }

    public function removeInCart(Request $request) {
        $user = Auth::guard('customer')->user()->id;
        $productId = $request->product_id;
        $cart = Cart::where(['customer_id' => $user, 'product_id' => $productId])->delete();
        return response()->json(['message' => 'remove cart success'], 200);
    }

    public function viewCart() {
        $carts = Cart::where('customer_id', Auth::guard('customer')->user()->id)->with('product', 'product.product_image')->get();
        return view('cart')->with(['cart' => $carts]);
    }
}
