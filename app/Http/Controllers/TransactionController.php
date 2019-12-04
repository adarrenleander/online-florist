<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Courier;
use App\DetailTransaction;
use App\Flower;
use App\HeaderTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function cart() {
        $id = Auth::user()->id;
        
        $data = [
            'carts' => Cart::where('user_id', '=', $id)->get(),
            'couriers' => Courier::all()
        ];

        return view('transactions.cart')->with($data);
    }

    public function order($flower_id) {
        $exists = False;
        $user_id = Auth::user()->id;

        $currentCart = Cart::all();

        foreach ($currentCart as $curr) {
            if ($curr->flower_id == $flower_id) {
                $newQuantity = $curr->quantity + 1;
                Cart::where([['user_id', '=', $user_id], ['flower_id', '=', $flower_id]])->update(['quantity' => $newQuantity]);
                
                $exists = True;
                break;
            }
        }

        if (!$exists) {
            $cart = new Cart;
            $cart->user_id = $user_id;
            $cart->flower_id = $flower_id;
            $cart->quantity = 1;

            $cart->save();
        }

        return back();
    }

    public function add(Request $request, $flower_id) {
        $rules = [
            'quantity' => 'required|numeric|min:1',
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        else {
            $exists = False;
            $user_id = Auth::user()->id;

            $currentCart = Cart::all();

            foreach ($currentCart as $curr) {
                if ($curr->flower_id == $flower_id) {
                    $newQuantity = $curr->quantity + $request->quantity;
                    Cart::where([['user_id', '=', $user_id], ['flower_id', '=', $flower_id]])->update(['quantity' => $newQuantity]);
                    
                    $exists = True;
                    break;
                }
            }

            if (!$exists) {
                $cart = new Cart;
                $cart->user_id = $user_id;
                $cart->flower_id = $flower_id;
                $cart->quantity = $request->quantity;

                $cart->save();
            }

            return redirect('/cart');
        }
    }

    public function remove($flower_id) {
        $user_id = Auth::user()->id;
        Cart::where([['user_id', '=', $user_id], ['flower_id', '=', $flower_id]])->delete();

        return redirect('/cart');
    }

    public function checkout(Request $request) {
        $transactionDate = Carbon::now();
        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id', '=', $user_id)->get();
        $couriers = Courier::all();

        if ($carts->isNotEmpty()) {
            $ht = new HeaderTransaction;
            $ht->user_id = $user_id;

            foreach ($couriers as $courier) {
                if ($courier->courier_name.' - '.$courier->shipping_cost == $request->courier) {
                    $ht->courier_id = $courier->id;
                    break;
                }
            }

            $ht->transaction_date = $transactionDate;
            $ht->save();

            foreach ($carts as $cart) {
                $dt = new DetailTransaction;
                $dt->header_transaction_id = $ht->id;
                $dt->flower_id = $cart->flower_id;
                $dt->quantity = $cart->quantity;

                $flower = Flower::where('id', '=', $cart->flower_id)->first();
                $newStock = $flower->stock - $cart->quantity;
                Flower::where('id', '=', $cart->flower_id)->update(['stock' => $newStock]);

                $dt->save();
            }

            Cart::where('user_id', '=', $user_id)->delete();
        }
        
        return redirect('/home');
    }

    public function history() {
        $data = [
            'transactions' => HeaderTransaction::all(),
            'details' => DetailTransaction::all()
        ];
        
        return view('transactions.transaction_history')->with($data);
    }
}
