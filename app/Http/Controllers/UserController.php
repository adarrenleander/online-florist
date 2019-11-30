<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // to show user's Profile page
    public function profile() {
        $id = Auth::user()->id;

        $data = [
            'user' => User::where('id', '=', $id)->first()
        ];

        return view('users.profile')->with($data);
    }

    // to update user's profile
    public function updateProfile(Request $request, $id) {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|regex:/^[0-9]+$/i|min:8|max:12',
            'gender' => 'required|in:male,female',
            'address' => 'required|min:10',
            'profile_picture' => 'required|mimes:jpeg,png,jpg',
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        else {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->gender = $request->gender;
            $user->address = $request->address;

            $image = $request->file('profile_picture');
            $imageExtension = $image->getClientOriginalExtension();
            $imageName = $request->name.'.'.$imageExtension;
            $user->profile_picture = '/storage/images/users/'.$imageName;

            Storage::putFileAs('public/images/users/', $image, $imageName);

            $user->save();
        }

        return redirect('/profile');
    }

    // to show Manage Users page
    public function index() {
        $data = [
            'users' => User::all()
        ];

        return view('users.manage_users')->with($data);
    }

    public function showUpdate($id) {
        $data = [
            'user' => User::where('id', '=', $id)->first()
        ];

        return view('users.update_user')->with($data);
    }

    public function update(Request $request, $id) {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|regex:/^[0-9]+$/i|min:8|max:12',
            'gender' => 'required|in:male,female',
            'address' => 'required|min:10',
            'profile_picture' => 'required|mimes:jpeg,png,jpg',
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        else {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->gender = $request->gender;
            $user->address = $request->address;

            $image = $request->file('profile_picture');
            $imageExtension = $image->getClientOriginalExtension();
            $imageName = $request->name.'.'.$imageExtension;
            $user->profile_picture = '/storage/images/users/'.$imageName;

            Storage::putFileAs('public/images/users/', $image, $imageName);

            $user->save();
        }

        return redirect('/manage-users');
    }

    public function delete($id) {
        $user = User::find($id);
        $user->delete();

        return redirect('/manage-users');
    }
}
