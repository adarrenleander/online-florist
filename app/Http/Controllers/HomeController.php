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
    public function index() {
        $data = [
            'flowers' => Flower::paginate(10),
            'dateTime' => Carbon::now()->setTimezone('Asia/Jakarta')->toDayDateTimeString()
        ];

        return view('home')->with($data);
    }

    public function search(Request $request) {
        $search = $request->search;

        $data = [
            'flowers' => Flower::where('name', 'like', '%'.$search.'%')->orWhere('description', 'like', '%'.$search.'%')->paginate(10)
        ];

        return view('home')->with($data);
    }
}
