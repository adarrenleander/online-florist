<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // called when initially opening the user's Profile page
    public function profile() {
        $id = Auth::user()->id; // get the id of the currently logged in user

        $data = [
            'user' => User::where('id', '=', $id)->first()  // get the data of the user with the id
        ];

        return view('users.profile')->with($data);  // display the Profile view, along with the data of the current user
    }

    // called when user updates his/her profile in the Profile page
    public function updateProfile(Request $request, $id) {
        // validation rules for the fields
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|regex:/^[0-9]+$/i|min:8|max:12',
            'gender' => 'required|in:male,female',
            'address' => 'required|min:10',
            'profile_picture' => 'required|mimes:jpeg,png,jpg',
        ];

        $validate = Validator::make($request->all(), $rules);   // conduct the validation of data from fields

        if ($validate->fails()) {
            // if there is an error in validation
            // return back to the Profile page, and pass the old data, as well as the errors
            return back()->withInput()->withErrors($validate);
        }
        else {
            // if validation passed
            // find the current user from the database and get its instance
            // update the attributes
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->gender = $request->gender;
            $user->address = $request->address;

            $image = $request->file('profile_picture'); // get the image file from the request
            $imageExtension = $image->getClientOriginalExtension(); // get the file extension
            $imageName = $request->name.'.'.$imageExtension;    // create the filename
            $user->profile_picture = '/storage/images/users/'.$imageName;   // save the image path to the database

            Storage::putFileAs('public/images/users/', $image, $imageName); // store the image to the storage folder

            $user->save();  // save the updated user profile to the database
        }

        return redirect('/profile');    // redirect back to the Profile page
    }

    // called when initially opening the Manage Users page
    public function index() {
        $data = [
            'users' => User::all()  // gets the data of all users
        ];

        return view('users.manage_users')->with($data); // display the Manage Users view and pass all of the users data
    }

    // called when initially opening the Update User page of a particular user
    // $id is passed to get the user that is to be updated
    public function showUpdate($id) {
        $data = [
            'user' => User::where('id', '=', $id)->first()  // get the data of the user with the passed id
        ];

        return view('users.update_user')->with($data);  // display the Update User view, along with the data of the selected user
    }

    // called when admin updates an existing user in the Update User page
    public function update(Request $request, $id) {
        // validation rules for the fields
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|regex:/^[0-9]+$/i|min:8|max:12',
            'gender' => 'required|in:male,female',
            'address' => 'required|min:10',
            'profile_picture' => 'required|mimes:jpeg,png,jpg',
        ];

        $validate = Validator::make($request->all(), $rules);   // conduct the validation of data from fields

        if ($validate->fails()) {
            // if there is an error in validation
            // return back to the Update User page, and pass the old data, as well as the errors
            return back()->withInput()->withErrors($validate);
        }
        else {
            // if validation passed
            // find the selected user from the database and get its instance
            // update the attributes
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->gender = $request->gender;
            $user->address = $request->address;

            $image = $request->file('profile_picture'); // get the image file from the request
            $imageExtension = $image->getClientOriginalExtension(); // get the file extension
            $imageName = $request->name.'.'.$imageExtension;    // create the filename
            $user->profile_picture = '/storage/images/users/'.$imageName;   // save the image path to the database

            Storage::putFileAs('public/images/users/', $image, $imageName); // store the image to the storage folder

            $user->save();  // save the updated user to the database
        }

        return redirect('/manage-users');   // redirect back to the Manage Users page
    }

    // called when admin removes a user using the Manage User page
    public function remove($id) {
        // check if the user requested to remove his/her own account
        // if false, then proceed
        if ($id != Auth::user()->id) {
            $user = User::find($id);    // find the selected user from database and get its instance
            $user->delete();    // perform the delete
        }

        return redirect('/manage-users');   // redirect back to the Manage Users page
    }
}
