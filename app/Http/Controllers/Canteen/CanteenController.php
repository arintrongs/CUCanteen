<?php

namespace App\Http\Controllers\Canteen;

use App\Comment;
use App\Shop;
use App\Food;
use App\Http\Controllers\Canteen\UserController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class CanteenController extends Controller
{
	/**
     * Show the cu canteen page.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $all_shops = Shop::get();
        for ($i=0; $i < count($all_shops); $i++) { 
            $all_shops[$i]['rating'] = Shop::getShopRating($all_shops[$i]['shop_id']);
            $all_shops[$i]['shop_picture'] = ($all_shops[$i]['shop_picture'] != '') ? Config::get('image.full_size', 'uploads/') . $all_shops[$i]['shop_picture'] : asset('img/food/test.jpg');
        }
        $data = array(
            'shops' => $all_shops,
            'location' => Shop::all()->pluck('shop_location'),
        );
        
        if (UserController::check($request))
            $data['user'] = $request->session()->get('un');
        return view('canteen/home', $data);
    }

    /**
     * Get data for show the store page.
     *
     * @return Response json
     */
    public function show(Request $request, $id = 0)
    {
        if (! $request->ajax()) {
            return response('Unauthorized.', 401);
        }

        $tmp = Shop::select(array('shop_name', 'shop_location', 'shop_time', 'shop_description', 'shop_isVeg', 'shop_isHalal', 'shop_picture'))->where('shop_id', $id)->first();
        $data = array(
            'id' => $id,
            'name' => $tmp['shop_name'],
            'description' => $tmp['shop_description'],
            'img' => ($tmp['shop_picture'] != '') ? Config::get('image.full_size', 'uploads/') . $tmp['shop_picture'] : asset('img/food/test.jpg'),
            'foods' => Food::where('shop_id', $id)->get(),
            'rating' => Shop::getShopRating($id),
            'comments' => Comment::getCommentShop(),
        );
        return response()->json($data);
    }

    public function scopeDist(Request $request) 
    {
        if (! $request->ajax()) {
            return response('Unauthorized.', 401);
        }

        $lat = $request->input('lat');
        $lng = $request->input('lng');
        $data = Shop::dist($lat, $lng, 100)->get();
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['rating'] = Shop::getShopRating($data[$i]['shop_id']);
            $data[$i]['distance'] = $this->toDistance($lat, $lng, $data[$i]['shop_lat'], $data[$i]['shop_lng']);
        }
        return response()->json($data);
    }

    /**
     * Store the comment.
     *
     * @return Array
     */
    public function store(Request $request)
    {
        if (! $request->ajax()) {
            return response('Unauthorized.', 401);
        }

        if(! UserController::check($request))
        {
            return 'logon';
        }

        $data = array(
            'shop_id' => $request->input('shop_id'),
            'user_id' => $request->session()->get('uid'),
            'comment' => $request->input('comment'),
            'rating' => $request->input('rating'),
        );
        
        return Comment::addComment($data);
    }
    
    private function toDistance($lat1, $lng1, $lat2, $lng2) {
        $rad1 = $lat1 * M_PI / 180;
        $rad2 = $lat2 * M_PI / 180;
        $diff_rad = ($lat2 - $lat1) * M_PI / 180;
        $diff_lam = ($lng2 - $lng1) * M_PI / 180;

        $a = sin($diff_rad/2) * sin($diff_rad/2) + cos($rad1) * cos($rad2) * sin($diff_lam/2) * sin($diff_lam/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));

        return 6371000 * $c;
    }

}