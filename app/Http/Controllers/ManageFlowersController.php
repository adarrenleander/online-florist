<?php

namespace App\Http\Controllers;

use App\Flower;
use App\FlowerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ManageFlowersController extends Controller
{
    public function index() {
        $data = [
            'flowers' => Flower::paginate(10)
        ];

        return view('manage_flowers')->with($data);
    }

    public function search(Request $request) {
        $search = $request->search;

        $data = [
            'flowers' => Flower::where('name', 'like', '%'.$search.'%')->orWhere('description', 'like', '%'.$search.'%')->paginate(10)
        ];

        return view('manage_flowers')->with($data);
    }

    public function getUpdate($id) {
        $data = [
            'flower' => Flower::where('id', '=', $id)->first(),
            'types' => FlowerType::all()
        ];

        return view('update_flower')->with($data);
    }

    public function postUpdate(Request $request, $id) {
        // dd($request);
        $rules = [
            'name' => 'required|min:3',
            'type' => 'required|not_in:-- Select Type --',
            'price' => 'required|numeric|min:10000',
            'description' => 'required|between:20,200',
            'stock' => 'required|numeric|gt:1',
            'image' => 'required|mimes:jpeg,png,jpg',
        ];
        
        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return back()->withErrors($validate);
        }
        else {
            $flower = Flower::find($id);
            $flower->name = $request->name;

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

            if (isset($request->image)) {
                $image = $request->file('image');
                $imageExtension = $image->getClientOriginalExtension();
                $imageName = $request->name.'.'.$imageExtension;
                $flower->image = '/storage/images/flowers/'.$imageName;

                Storage::putFileAs('public/images/flowers/', $image, $imageName);
            }

            $flower->save();
        }

        return redirect('/manage-flowers');
    }

    public function delete($id) {
        $flower = Flower::find($id);
        $flower->delete();

        return redirect('/manage-flowers');
    }
}
