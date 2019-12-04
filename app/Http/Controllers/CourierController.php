<?php

namespace App\Http\Controllers;

use App\Courier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourierController extends Controller
{
    // called when initially opening the Manage Couriers page
    public function index(Request $request) {
        $search = $request->search; // gets the keyword that user searched

        $data = [
            // gets all courier data where the keyword is present in the courier's name
            // in the form of a pagination of 10 datas per page
            'couriers' => Courier::where('courier_name', 'like', '%'.$search.'%')->paginate(10)
        ];

        return view('couriers.manage_couriers')->with($data);   // display the Manage Couriers view and pass the results of the search
    }

    // called when initially opening the Insert Courier page
    public function showInsert() {
        return view('couriers.insert_courier'); // display the Insert Courier view
    }

    // called when admin inserts a new courier in the Insert Courier page
    public function insert(Request $request) {
        // validation rules for the fields
        $rules = [
            'courier_name' => 'required|min:3',
            'shipping_cost' => 'required|numeric|min:3000',
        ];

        $validate = Validator::make($request->all(), $rules);   // conduct the validation of data from fields

        if ($validate->fails()) {
            // if there is an error in validation
            // return back to the Insert Courier page, and pass the old data, as well as the errors
            return back()->withInput()->withErrors($validate);
        }
        else {
            // if validation passed
            // create an instance of a new courier and fill in appropriate attributes
            $courier = new Courier;
            $courier->courier_name = $request->courier_name;
            $courier->shipping_cost = $request->shipping_cost;

            $courier->save();   // save the courier to the database
        }

        return redirect('/manage-couriers');    // redirect back to the Manage Couriers page
    }

    // called when initially opening the Update Courier page of a particular courier
    // $id is passed to get the courier that is to be updated
    public function showUpdate($id) {
        $data = [
            'courier' => Courier::where('id', '=', $id)->first()    // get the data of the courier with the passed id
        ];

        return view('couriers.update_courier')->with($data);    // display the Update Courier view, along with the data of the selected courier
    }

    // called when admin updates an existing courier in the Update Courier page
    public function update(Request $request, $id) {
        // validation rules for the fields
        $rules = [
            'courier_name' => 'required|min:3',
            'shipping_cost' => 'required|numeric|min:3000',
        ];

        $validate = Validator::make($request->all(), $rules);   // conduct the validation of data from fields

        if ($validate->fails()) {
            // if there is an error in validation
            // return back to the Update Courier page, and pass the old data, as well as the errors
            return back()->withInput()->withErrors($validate);
        }
        else {
            // if validation passed
            // find the selected courier from the database and get its instance
            // update the attributes
            $courier = Courier::find($id);
            $courier->courier_name = $request->courier_name;
            $courier->shipping_cost = $request->shipping_cost;

            $courier->save();   // save the updated courier to the database
        }

        return redirect('/manage-couriers');    // redirect back to the Manage Couriers page
    }

    // called when admin deletes a courier using the Manage Courier page
    public function delete($id) {
        $courier = Courier::find($id);  // find the selected courier from database and get its instance
        $courier->delete(); // perform the delete

        return redirect('/manage-couriers');    // redirect back to the Manage Couriers page
    }
}
