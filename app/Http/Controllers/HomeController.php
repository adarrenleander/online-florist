<?php

namespace App\Http\Controllers;

use App\Flower;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request) {
        $search = $request->search;

        $data = [
            'flowers' => Flower::where('name', 'like', '%'.$search.'%')->orWhere('description', 'like', '%'.$search.'%')->paginate(10),
            'dateTime' => Carbon::now()->toDayDateTimeString()
        ];

        return view('home')->with($data);
    }

    public function welcome() {
        $data = [
            'dateTime' => Carbon::now()->toDayDateTimeString()
        ];
    
        return view('welcome')->With($data);
    }
}
