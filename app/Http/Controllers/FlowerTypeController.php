<?php

namespace App\Http\Controllers;

use App\FlowerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FlowerTypeController extends Controller
{
    // called when initially opening the Manage Flower Types page
    public function index(Request $request) {
        $search = $request->search; // gets the keyword that user searched

        $data = [
            // gets all flower type data where the keyword is present in the flower type's name
            // in the form of a pagination of 10 datas per page
            'flowerTypes' => FlowerType::where('type_name', 'like', '%'.$search.'%')->paginate(10)
        ];

        return view('flower_types.manage_flower_types')->with($data);   // display the Manage Flower Types view and pass the results of the search
    }

    // called when initially opening the Insert Flower Type page
    public function showInsert() {
        return view('flower_types.insert_flower_type'); // display the Insert Flower Type view
    }

    // called when admin inserts a new flower type in the Insert Flower Type page
    public function insert(Request $request) {
        // validation rules for the fields
        $rules = [
            'type_name' => 'required|unique:flower_types,type_name|min:4',
        ];

        $validate = Validator::make($request->all(), $rules);   // conduct the validation of data from fields

        if ($validate->fails()) {
            // if there is an error in validation
            // return back to the Insert Flower Type page, and pass the old data, as well as the errors
            return back()->withInput()->withErrors($validate);
        }
        else {
            // if validation passed
            // create an instance of a new flower type and fill in appropriate attributes
            $flowerType = new FlowerType;
            $flowerType->type_name = $request->type_name;

            $flowerType->save();    // save the flower type to the database
        }

        return redirect('/manage-flower-types');    // redirect back to the Manage Flower Types page
    }

    // called when initially opening the Update Flower Type page of a particular flower type
    // $id is passed to get the flower type that is to be updated
    public function showUpdate($id) {
        $data = [
            'flowerType' => FlowerType::where('id', '=', $id)->first()  // get the data of the flower type with the passed id
        ];

        return view('flower_types.update_flower_type')->with($data);    // display the Update Flower view, along with the data of the selected flower type
    }

    // called when admin updates an existing flower type in the Update Flower Type page
    public function update(Request $request, $id) {
        // validation rules for the fields
        $rules = [
            'type_name' => 'required|unique:flower_types,type_name|min:4',
        ];

        $validate = Validator::make($request->all(), $rules);   // conduct the validation of data from fields

        if ($validate->fails()) {
            // if there is an error in validation
            // return back to the Update Flower Type page, and pass the old data, as well as the errors
            return back()->withInput()->withErrors($validate);
        }
        else {
            // if validation passed
            // find the selected flower type from the database and get its instance
            // update the attributes
            $flowerType = FlowerType::find($id);
            $flowerType->type_name = $request->type_name;

            $flowerType->save();    // save the updated flower type to the database
        }

        return redirect('/manage-flower-types');    // redirect back to the Manage Flower Types page
    }

    // called when admin deletes a flower type using the Manage Flower Type page
    public function delete($id) {
        $flowerType = FlowerType::find($id);    // find the selected flower type from database and get its instance
        $flowerType->delete();  // perform the delete

        return redirect('/manage-flower-types');    // redirect back to the Manage Flower Types page
    }
}
