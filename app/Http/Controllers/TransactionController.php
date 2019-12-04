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

// the TransactionController is used by everything surrounding transactions
// including: carts, adding to carts, orders, transaction history

class TransactionController extends Controller
{
    // called when initially opening the user's Cart page
    public function cart() {
        $id = Auth::user()->id; // get the id of the currently logged in user
        
        $data = [
            'carts' => Cart::where('user_id', '=', $id)->get(), // get the data of the cart where the user_id matches the current user's id
            'couriers' => Courier::all()    // get all courier data
        ];

        return view('transactions.cart')->with($data);  // display the Cart view, along with the data of the current user's cart and all courier data
    }

    // called when user makes an order for a flower using the Home (Catalog) page
    // this method will add the flower to cart with quantity of 1
    public function order($flower_id) {
        $exists = False;    // boolean value to signify whether flower exists in user's cart or not
        $user_id = Auth::user()->id;    // get the id of the currently logged in user

        $currentCart = Cart::all(); // get all of the cart data

        // iterrate over each cart data
        // to check whether the flower to be inserted into cart already exists in the cart
        foreach ($currentCart as $curr) {
            if ($curr->flower_id == $flower_id) {
                // if flower exists in the current user's cart,
                $newQuantity = $curr->quantity + 1; // add 1 to the quantity
                // and update the quantity in the cart
                Cart::where([['user_id', '=', $user_id], ['flower_id', '=', $flower_id]])->update(['quantity' => $newQuantity]);
                
                $exists = True;
                break;
            }
        }

        // if flower does not exists in current user's cart
        if (!$exists) {
            // create an instance of a new cart data and fill in appropriate attributes
            $cart = new Cart;
            $cart->user_id = $user_id;
            $cart->flower_id = $flower_id;
            $cart->quantity = 1;

            $cart->save();  // save the cart data to the database
        }

        return back();  // redirect back to the Home (Catalog) page
    }

    // called when user adds a flower to his/her cart using the Flower Details page
    // this method will add the flower to cart with quantity according to user's input
    public function add(Request $request, $flower_id) {
        // validation rules for flower quantity
        // validation for whether quantity exceeds stock is made in the view
        $rules = [
            'quantity' => 'required|numeric|min:1',
        ];

        $validate = Validator::make($request->all(), $rules);   // conduct the validation of data from fields

        if ($validate->fails()) {
            // if there is an error in validation
            // return back to the Flower Details page, and pass the old data, as well as the errors
            return back()->withInput()->withErrors($validate);
        }
        else {
            $exists = False;    // boolean value to signify whether flower exists in user's cart or not
            $user_id = Auth::user()->id;    // get the id of the currently logged in user

            $currentCart = Cart::all(); // get all of the cart data

            // iterrate over each cart data
            // to check whether the flower to be inserted into cart already exists in the cart
            foreach ($currentCart as $curr) {
                if ($curr->flower_id == $flower_id) {
                    // if flower exists in the current user's cart,
                    $newQuantity = $curr->quantity + $request->quantity;    // add quantity that user specified to current quantity
                    // and update the quantity in the cart
                    Cart::where([['user_id', '=', $user_id], ['flower_id', '=', $flower_id]])->update(['quantity' => $newQuantity]);
                    
                    $exists = True;
                    break;
                }
            }

            // if flower does not exists in current user's cart
            if (!$exists) {
                // create an instance of a new cart data and fill in appropriate attributes
                $cart = new Cart;
                $cart->user_id = $user_id;
                $cart->flower_id = $flower_id;
                $cart->quantity = $request->quantity;

                $cart->save();  // save the cart data to the database
            }

            return redirect('/cart');   // redirect to the Cart page
        }
    }

    // called when user removes an item from his/her cart
    // item's flower_id is passed to this function
    public function remove($flower_id) {
        $user_id = Auth::user()->id;    // get the id of the currently logged in user 
        // find the cart data with the associated user_id and flower_id
        // and delete from the database
        Cart::where([['user_id', '=', $user_id], ['flower_id', '=', $flower_id]])->delete();

        return redirect('/cart');   // redirect back to the Cart page
    }

    // called when user wants to checkout the flowers in his/her cart
    public function checkout(Request $request) {
        $transactionDate = Carbon::now();   // the transaction date is the current date and time, using Carbon's default timezone
        $user_id = Auth::user()->id;    // get the id of the currently logged in user
        $carts = Cart::where('user_id', '=', $user_id)->get();  // get all cart data of current user
        $couriers = Courier::all(); // get all courier data

        // check if cart is empty
        // if cart is not empty, means there are items in cart, so proceed
        if ($carts->isNotEmpty()) {
            // create a new instance of header transaction and fill in appropriate attributes
            $ht = new HeaderTransaction;
            $ht->user_id = $user_id;

            // iterrate over all couriers
            // to find the correct courier the user has chosen
            foreach ($couriers as $courier) {
                if ($courier->courier_name.' - '.$courier->shipping_cost == $request->courier) {
                    $ht->courier_id = $courier->id;
                    break;
                }
            }

            $ht->transaction_date = $transactionDate;
            $ht->save();    // save the header transaction data to the database

            // iterrate for each cart data
            foreach ($carts as $cart) {
                // create a new instance of detail transaction and fill in appropriate attributes
                $dt = new DetailTransaction;
                $dt->header_transaction_id = $ht->id;   // header_transaction_id is the id of the previously created header transaction
                $dt->flower_id = $cart->flower_id;
                $dt->quantity = $cart->quantity;

                // reduce the stock of each flower based on the quantity purchased
                $flower = Flower::where('id', '=', $cart->flower_id)->first();
                $newStock = $flower->stock - $cart->quantity;
                // update the stock in the database
                Flower::where('id', '=', $cart->flower_id)->update(['stock' => $newStock]);

                $dt->save();    // save each detail transaction data to the database
            }

            Cart::where('user_id', '=', $user_id)->delete();    // delete all of the current user's cart data
        }
        
        return redirect('/home');   // redirect tp the Home (Catalog) page
    }

    // called when initially opening the Transaction History page
    public function history() {
        $data = [
            'transactions' => HeaderTransaction::all(), // get all data of header transaction
            'details' => DetailTransaction::all()   // get all data of detail transaction
        ];
        
        return view('transactions.transaction_history')->with($data);   // display the Transaction History view and pass the data
    }
}
