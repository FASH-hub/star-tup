<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tchat;
use App\Models\Users;

class TchatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating and saving a new tchat.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTch(Request $request)
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
     * Display tchats by users.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUserTchat()
    {
        return Users::all()->tchat;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
