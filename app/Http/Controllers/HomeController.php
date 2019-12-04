<?php

namespace App\Http\Controllers;

use App\Flower;
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

    // called when initially opening the Home page, which is the Catalog
    public function index(Request $request) {
        $search = $request->search; // gets the keyword that user searched

        $data = [
            // gets all flower data where the keyword is present in the flower's name or description
            // in the form of a pagination of 10 datas per page
            'flowers' => Flower::where('name', 'like', '%'.$search.'%')->orWhere('description', 'like', '%'.$search.'%')->paginate(10)
        ];

        return view('home')->with($data);   // display the Home view and pass the results of the search
    }

    // called when initially opening the Welcome page, which is the landing page of the website
    public function welcome() {
        return view('welcome'); // display the Welcome view
    }
}
