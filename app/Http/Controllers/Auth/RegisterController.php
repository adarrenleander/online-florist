<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // validation rules for the fields
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|alpha_dash|min:5|confirmed',
            'password_confirmation' => 'required',
            'phone' => 'required|regex:/^[0-9]+$/i|min:8|max:12',
            'gender' => 'required|in:male,female',
            'address' => 'required|min:10',
            'profile_picture' => 'required|mimes:jpeg,png,jpg',
        ];

        // conduct validation
        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // the image in this case is an UploadedFile object
        $image = $data['profile_picture'];  // get the image from form
        $imageExtension = $image->extension();  // get the image extension
        $imageName = $data['name'].'.'.$imageExtension; // create the image filename
        $imagePath = '/storage/images/users/'.$imageName;   // create the image file path

        Storage::putFileAs('public/images/users/', $image, $imageName); // store the image in the storage folder

        // create the new user
        // new users created using the Register page are always only "member"
        // to add new admins, must seed or insert manually to database
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'address' => $data['address'],
            'profile_picture' => $imagePath,
            'role' => 'member'
        ]);
    }
}
