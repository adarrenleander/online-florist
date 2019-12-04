<?php

namespace App\Http\Controllers;

use App\Flower;
use App\FlowerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FlowerController extends Controller
{
    // called when initially opening the Flower Details page
    // $id is passed to get the flower that is to be shown
    public function details($id) {
        $data = [
            'flower' => Flower::where('id', '=', $id)->first()  // get the data of the flower with the passed id
        ];

        return view('flowers.flower_details')->with($data); // display the Flower Details view, along with the data of the selected flower
    }

    // called when initially opening the Manage Flowers page
    public function index(Request $request) {
        $search = $request->search; // gets the keyword that user searched

        $data = [
            // gets all flower data where the keyword is present in the flower's name or description
            // in the form of a pagination of 10 datas per page
            'flowers' => Flower::where('name', 'like', '%'.$search.'%')->orWhere('description', 'like', '%'.$search.'%')->paginate(10)
        ];

        return view('flowers.manage_flowers')->with($data); // display the Manage Flowers view and pass the results of the search
    }

    // called when initially opening the Insert Flower page
    public function showInsert() {
        $data = [
            'types' => FlowerType::all()    // get the data of all flower types
        ];

        return view('flowers.insert_flower')->with($data);  // display the Insert Flower view and pass the flower type data
    }

    // called when admin inserts a new flower in the Insert Flower page
    public function insert(Request $request) {
        // validation rules for the fields
        $rules = [
            'name' => 'required|min:3',
            'type' => 'required|not_in:-- Select Type --',
            'price' => 'required|numeric|min:10000',
            'description' => 'required|between:20,200',
            'stock' => 'required|numeric|gt:0',
            'image' => 'required|mimes:jpeg,png,jpg',
        ];

        $validate = Validator::make($request->all(), $rules);   // conduct the validation of data from fields

        if ($validate->fails()) {
            // if there is an error in validation
            // return back to the Insert Flower page, and pass the old data, as well as the errors
            return back()->withInput()->withErrors($validate);
        }
        else {
            // if validation passed
            // create an instance of a new flower and fill in appropriate attributes
            $flower = new Flower;
            $flower->name = $request->name;

            // search for flower type with the corresponding id
            $types = FlowerType::all();
            foreach ($types as $type) {
                if ($type->type_name == $request->type) {
                    $flower->type_id = $type->id;
                    break;
                }
            }

            $flower->price = $request->price;
            $flower->description = $request->description;
            $flower->stock = $request->stock;

            $image = $request->file('image');   // get the image file from the request
            $imageExtension = $image->getClientOriginalExtension(); // get the file extension
            $imageName = $request->name.'.'.$imageExtension;    // create the filename
            $flower->image = '/storage/images/flowers/'.$imageName; // save the image path to the database

            Storage::putFileAs('public/images/flowers/', $image, $imageName);   // store the image to the storage folder

            $flower->save();    // save the flower to the database
        }

        return redirect('/manage-flowers'); // redirect back to the Manage Flowers page
    }

    // called when initially opening the Update Flower page of a particular flower
    // $id is passed to get the flower that is to be updated
    public function showUpdate($id) {
        $data = [
            'flower' => Flower::where('id', '=', $id)->first(), // get the data of the flower with the passed id
            'types' => FlowerType::all()    // get the data of all flower types
        ];

        return view('flowers.update_flower')->with($data);  // display the Update Flower view, along with the data of the selected flower and all flower types
    }

    // called when admin updates an existing flower in the Update Flower page
    public function update(Request $request, $id) {
        // validation rules for the fields
        $rules = [
            'name' => 'required|min:3',
            'type' => 'required|not_in:-- Select Type --',
            'price' => 'required|numeric|min:10000',
            'description' => 'required|between:20,200',
            'stock' => 'required|numeric|gt:0',
            'image' => 'required|mimes:jpeg,png,jpg',
        ];
        
        $validate = Validator::make($request->all(), $rules);   // conduct the validation of data from fields

        if ($validate->fails()) {
            // if there is an error in validation
            // return back to the Update Flower page, and pass the old data, as well as the errors
            return back()->withInput()->withErrors($validate);
        }
        else {
            // if validation passed
            // find the selected flower from the database and get its instance
            // update the attributes
            $flower = Flower::find($id);
            $flower->name = $request->name;

            // search for flower type with the corresponding id
            $types = FlowerType::all();
            foreach ($types as $type) {
                if ($type->type_name == $request->type) {
                    $flower->type_id = $type->id;
                    break;
                }
            }

            $flower->price = $request->price;
            $flower->description = $request->description;
            $flower->stock = $request->stock;

            $image = $request->file('image');   // get the image file from the request
            $imageExtension = $image->getClientOriginalExtension(); // get the file extension
            $imageName = $request->name.'.'.$imageExtension;    // create the filename
            $flower->image = '/storage/images/flowers/'.$imageName; // save the image path to the database

            Storage::putFileAs('public/images/flowers/', $image, $imageName);   // store the image to the storage folder

            $flower->save();    // save the updated flower to the database
        }

        return redirect('/manage-flowers'); // redirect back to the Manage Flowers page
    }

    // called when admin deletes a flower using the Manage Flower page
    public function delete($id) {
        $flower = Flower::find($id);    // find the selected flower from database and get its instance
        $flower->delete();  // perform the delete

        return redirect('/manage-flowers'); // redirect back to the Manage Flowers page
    }
}
