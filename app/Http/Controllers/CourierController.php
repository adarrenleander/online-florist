<?php

namespace App\Http\Controllers;

use App\Courier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourierController extends Controller
{
    public function index(Request $request) {
        $search = $request->search;

        $data = [
            'couriers' => Courier::where('courier_name', 'like', '%'.$search.'%')->paginate(10)
        ];

        return view('couriers.manage_couriers')->with($data);
    }

    public function showInsert() {
        return view('couriers.insert_courier');
    }

    public function insert(Request $request) {
        $rules = [
            'courier_name' => 'required|min:3',
            'shipping_cost' => 'required|numeric|min:3000',
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        else {
            $courier = new Courier;
            $courier->courier_name = $request->courier_name;
            $courier->shipping_cost = $request->shipping_cost;

            $courier->save();
        }

        return redirect('/manage-couriers');
    }

    public function showUpdate($id) {
        $data = [
            'courier' => Courier::where('id', '=', $id)->first()
        ];

        return view('couriers.update_courier')->with($data);
    }

    public function update(Request $request, $id) {
        $rules = [
            'courier_name' => 'required|min:3',
            'shipping_cost' => 'required|numeric|min:3000',
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        else {
            $courier = Courier::find($id);
            $courier->courier_name = $request->courier_name;
            $courier->shipping_cost = $request->shipping_cost;

            $courier->save();
        }

        return redirect('/manage-couriers');
    }

    public function delete($id) {
        $courier = Courier::find($id);
        $courier->delete();

        return redirect('/manage-couriers');
    }
}
