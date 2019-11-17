<?php

namespace App\Http\Controllers;

use App\Flower;
use Illuminate\Http\Request;

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

    

    public function delete($id) {
        $flower = Flower::find($id);
        $flower->delete();

        return redirect('/manage-flowers');
    }
}
