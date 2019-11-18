<?php

namespace App\Http\Controllers;

use App\FlowerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FlowerTypeController extends Controller
{
    public function index() {
        $data = [
            'flowerTypes' => FlowerType::paginate(10)
        ];

        return view('manage_flower_types')->with($data);
    }

    public function search(Request $request) {
        $search = $request->search;

        $data = [
            'flowerTypes' => FlowerType::where('type_name', 'like', '%'.$search.'%')->paginate(10)
        ];

        return view('manage_flower_types')->with($data);
    }

    public function showInsert() {
        return view('insert_flower_type');
    }

    public function insert(Request $request) {
        $rules = [
            'type_name' => 'required|unique:flower_types,type_name|min:4',
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        else {
            $flowerType = new FlowerType;
            $flowerType->type_name = $request->type_name;

            $flowerType->save();
        }

        return redirect('/manage-flower-types');
    }

    public function showUpdate($id) {
        $data = [
            'flowerType' => FlowerType::where('id', '=', $id)->first(),
        ];

        return view('update_flower_type')->with($data);
    }

    public function update(Request $request, $id) {
        $rules = [
            'type_name' => 'required|unique:flower_types,type_name|min:4',
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        else {
            $flowerType = FlowerType::find($id);
            $flowerType->type_name = $request->type_name;

            $flowerType->save();
        }

        return redirect('/manage-flower-types');
    }

    public function delete($id) {
        $flowerType = FlowerType::find($id);
        $flowerType->delete();

        return redirect('/manage-flower-types');
    }
}