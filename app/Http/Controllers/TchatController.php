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
     * Creates and links tchat to user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id received tchat's id
     * @return string message
     */
    public function createTchatByUser(Request $request, $id)
    {
        $tchat = new Tchat();
        $tchat->subject = $request->subject;
        $tchat->bodys = $request->bodys;
        $tchat->save();

        $tchat->tchatByUser()->attach($id);
        return [" Message posted successfully"];
    }



    /**
     * Display user by tchats
     * @param  int  $id received tchat's id
     */
    public function displayUserByChat($id)
    {
        $tchat = Tchat::find($id);
        $user = $tchat->tchatByUser;
        return $user;
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
            return ['Your message has been updated successfully'];
        } else {
            return ['Message failed to be updated'];
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
            return ['your message has been deleted'];
        } else {
            return ['failed to be deleted'];
        }

    }
}
