<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Users;

class AuthController extends Controller
{
    /*
    * ------------------------------------------------
    * creates a new user
    * ------------------------------------------------
    */
    public function registerUser(Request $request)
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'birth_date' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:13'

        ]);

        $user = new Users();
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->birth_date = $request->birth_date;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->motto = $request->motto;
        $result = $user->save();

        if ($result) {
            return ['User' => 'has been successfully registered'];
        } else {
            return ['User' => 'failed to be registered'];
        }
    }

    /*
    * ------------------------------
    * Login
    * ------------------------------
    */
    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = Users::where(['email' => $request->email])->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            $request->session()->put('userId', $user->id);
            return ["message" => "Credentials issue, login failed"];
        } else {
            return ["message" => "You have been successfully logged in"];
        }
    }

    /*
    * ------------------------------
    * Display all users
    * ------------------------------
    */
    public function displayUsers()
    {
        return Users::all();
    }

    /*
    * ------------------------------
    * Display  user by id
    * ------------------------------
    */
    public function displayUsersId($id)
    {
        return Users::find($id);
    }
    

    /*
    * ------------------------------
    * Logout
    * ------------------------------
    */
    public function logout()
    {

        if (Session::has('userId')) {
            Session::pull('userId');
            return  redirect('login');
        }
    }




    /**
     * ----------------------------------
     * Delete an user from database.
     * ----------------------------------
     */
    public function deleteUser($id)
    {
        $user = Users::find($id);

        $resutl = $user->delete();

        if ($resutl) {
            return ["message" => "User has been deleted"];
        } else {
            return ["message" => "User couldn't be deleted"];
        }
    }




    /*
    * ------------------------------
    * Updates the user according to the received id.
    * ------------------------------
    */

    public function updateUser(Request $request, $id)
    {

        $user = UserS::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role;

        $member = $user->save();
        if ($member) {
            return ["message" => "user updated"];
        } else {
            return ["message" => " user couldn't be updated"];
        }
    }
}
