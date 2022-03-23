<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Product;
use App\Cart;

class CartController extends Controller
{

    //Cart
    public function viewCart(){
        $total = 0;
        $cart = [];
        if(Session::has("cart")) {
            $cart = Session::get("cart");
            foreach ($cart as $value) {
                $total += $value->price;
            }
        }
        return view('cart')->with('total', $total);
    }

    public function getCart() {
        $total = 0;
        $count = 0;
        $cart = [];
        if(Session::has("cart")) {
            $cart = Session::get("cart");

            foreach ($cart as $id => $item) {
                $product = Product::find($id);

                $item->name = $product->name;
                $item->price = $product->newPrice();
                $item->image = "/backend/images/product/".$product->product_image[0]->name;
                $item->link = route('home.detail', [$product->id, $product->getUrl()]);

                $total += $item->price * $item->quantity;
                $count += $item->quantity;
            }
        }

        return response()->json([
            'cart' => $cart,
            'total' => $total,
            'count' => $count
        ]);
    }

    public function addCart(Request $request) {
        $cart = [];
        if(Session::has("cart")) {
            $cart = Session::get("cart");
        }

        $quantity = 1;
        if($request->has('quantity')) {
            $quantity = $request->quantity;
        }

        $product = Product::find($request->has("id") ? $request->id : -1);

        if($product != null) {
            if(isset($cart[$request->id])) {
                $cur_cart = $cart[$request->id];
                $cur_cart->quantity += $quantity;
            } else {
                $new_cart = new Cart();

                $new_cart->quantity = $quantity;

                $cart[$product->id] = $new_cart;
            }

            Session::put(['cart' => $cart]);
        } else {
            return response()->json(['status'=>'error']);
        }
        return $this->getCart();
    }

    public function changeQuantity(Request $request) {
        $cart = [];
        if(Session::has("cart")) {
            $cart = Session::get("cart");
        }

        if(isset($cart[$request->id])) {
            $cur_cart = $cart[$request->id];
            if ($request->quantity == 0){
                unset($cart[$request->id]);
            } else {
                $cur_cart->quantity = $request->quantity;
            }
            Session::put(['cart' => $cart]);
        } else {
            return response()->json(['status'=>'error']);
        }

        return $this->getCart();
    }

    public function removeInCart(Request $request) {
        $cart = [];
        if(Session::has("cart")) {
            $cart = Session::get("cart");
        }

        if(isset($cart[$request->id])) {
            unset($cart[$request->id]);
            Session::put(['cart' => $cart]);
        } else {
            return response()->json(['status'=>'error']);
        }

        return $this->getCart();
    }
}
