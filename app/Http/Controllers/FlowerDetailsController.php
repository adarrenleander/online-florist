<?php

namespace App\Http\Controllers;

use App\Flower;
use Illuminate\Http\Request;

class FlowerDetailsController extends Controller
{
    public function index($id) {
        $data = [
            'flower' => Flower::where('id', '=', $id)->first()
        ];

        return view('flower_details')->with($data);
    }
}
