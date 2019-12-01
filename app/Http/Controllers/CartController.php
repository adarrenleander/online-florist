<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Courier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index() {
        $id = Auth::user()->id;
        
        $data = [
            'carts' => Cart::where('member_id', '=', $id)->get(),
            'totalPrice' => Cart::where('member_id', '=', $id)->get()->sum('quantity * price'),
            'couriers' => Courier::all(),
            'dateTime' => Carbon::now()->setTimezone('Asia/Jakarta')->toDayDateTimeString()
        ];

        return view('cart')->with($data);
    }

    public function order($flower_id) {
        $cart = new Cart;
        $cart->member_id = Auth::user()->id;
        $cart->flower_id = $flower_id;
        $cart->quantity = 1;

        $cart->save();

        return back();
    }

    public function add(Request $request, $flower_id) {
        $rules = [
            'quantity' => 'required|integer|min:1',
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        else {
            $cart = new Cart;
            $cart->member_id = Auth::user()->id;
            $cart->flower_id = $flower_id;
            $cart->quantity = $request->quantity;

            $cart->save();

            return redirect('/cart');
        }
    }

    public function remove($flower_id) {
        $member_id = Auth::user()->id;
        Cart::where([['member_id', '=', $member_id], ['flower_id', '=', $flower_id]])->delete();

        return redirect('/cart');
    }
}
