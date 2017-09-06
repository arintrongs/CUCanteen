<?php

namespace App\Http\Controllers\Canteen;

use App\Shop;
use App\Food;
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

        if (!property_exists($request, 'id'))
            $data['id'] = $request->id;
        if (!property_exists($request, 'location'))
            $data['location'] = $request->location;
        if (!property_exists($request, 'lat'))
            $data['lat'] = $request->lat;
        if (!property_exists($request, 'lng'))
            $data['lng'] = $request->lng;
        if (!property_exists($request, 'picture'))
            $data['picture'] = $request->picture;
        if (!property_exists($request, 'time'))
            $data['time'] = $request->time;
        if (!property_exists($request, 'isVeg'))
            $data['isVeg'] = $request->isVeg;
        if (!property_exists($request, 'isHalal'))
            $data['isHalal'] = $request->isHalal;
        if (!property_exists($request, 'food'))
            $data['food'] = $request->food;
        return json_encode(Shop::updateShop($data));
    }

    public function show(Request $request, $id = 0)
    {
        if (! $request->ajax()) {
            return response('Unauthorized.', 401);
        }

        $data = Shop::where('shop_id', $id)->get()->first();
        $data['shop_food'] = Food::where('shop_id', $id)->get();
        return response()->json($data);
    }

    public function destroy(Request $request, $id = 0)
    {
        if (! $request->ajax()) {
            return response('Unauthorized.', 401);
        }

        $data = Shop::where('shop_id', $id)->delete();
        return response()->json($data);
    }
}