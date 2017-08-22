<?php

namespace App\Http\Controllers\Canteen;

use App\Http\Controllers\Controller;

class BackdoorController extends Controller
{
	/**
     * Show the cu canteen page.
     *
     * @return Response
     */
    public function index()
    {
        return view('canteen/back');
    }
}