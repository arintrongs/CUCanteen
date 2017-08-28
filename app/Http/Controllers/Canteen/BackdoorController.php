<?php

namespace App\Http\Controllers\Canteen;

use App\Shop;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackdoorController extends Controller
{
	/**
     * Show the cu canteen page.
     *
     * @return Response
     */
    public function index()
    {
    	$all_shops = Shop::get();
    	$data = array(
    		'shops' => $all_shops,
    	);
        return view('canteen/back', $data);
    }

    public function store(Request $request)
    {
    	if (! $request->ajax()) {
            return response('Unauthorized.', 401);
        }

        $data = array(
        	'name' => $request->name,
        	'location' => $request->location,
        	'description' => $request->description,
        );
        return json_encode(Shop::updateShop($data));
    }
}