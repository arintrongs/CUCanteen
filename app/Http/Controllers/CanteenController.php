<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class CanteenController extends Controller
{
	/**
     * Show the cu canteen page.
     *
     * @return Response
     */
    public function index()
    {
        return view('canteen/page');
    }

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    /*public function show($id)
    {
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }*/
}