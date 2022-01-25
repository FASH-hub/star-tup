<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tchat;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class TchatController extends Controller
{
    /**
     * Display a listing of the tchats.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tchat::all();
    }



    /**
     * Show the form for creating and saving a new tchat.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $tchat = new Tchat();
        $tchat->subject = $request->subject;
        $tchat->bodys = $request->bodys;
        $result = $tchat->save();

        if ($result) {
            return ["message" => 'your message has been posted successfully'];
        } else {
            return ['message' => 'failed to be posted'];
        }
    }
    /**
     * Display the specified tchat.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Tchat::find($id);
    }


    /**
     * Links user to tchat
     * @param  \Illuminate\Http\Request  $request inputs
     * @param  int  $id received user's id'
     * @return string message
     */
    public  function attachUserTchat(Request $request, $id)
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
        $user->save();

        $tchatId = $id;
        $user->userTchat()->attach($tchatId);
        return "Saved successfully";
    }


    /**
     * Displays tchats by user.
     * 
     * @param  int  $id received user's id
     * @return string user's tchat
     */
    public function displayChatByUser($id)
    {
        $user = Users::find($id);
        $tchat = $user->userTchat;
        return $tchat;
    }

    /**
     * Links tchat to user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id received tchat's id
     * @return string message
     */
    public function attachTchatUser(Request $request, $id)
    {
        $tchat = new Tchat();
        $tchat->tchats = $request->tchats;
        $tchat->save();

        $tchat->tchatUser()->attach($id);
        return ["message" => "saved successfully"];
    }



    /**
     * Display user by tchats
     * @param  int  $id received tchat's id
     */
    public function displayUserByChat($id)
    {
        $user = Tchat::find($id);
        $tchat = $user->tchatUser;
        return $tchat;
    }

    /**
     * Update the specified tchat in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tchat = Tchat::find($id);
        $tchat->subject = $request->subject;
        $tchat->bodys = $request->bodys;
        $result = $tchat->save();

        if ($result) {
            return ["message" => 'your message has been updated successfully'];
        } else {
            return ['message' => 'failed to be updated'];
        }

    }

    /**
     * Remove the specified tchat from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tchat = Tchat::find($id);
        $result = $tchat->delete();

        if ($result) {
            return ["message" => 'your message has been deleted'];
        } else {
            return ['message' => 'failed to be deleted'];
        }

    }
}
