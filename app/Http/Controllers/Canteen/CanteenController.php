<?php

namespace App\Http\Controllers\Canteen;

use App\Comment;
use App\Shop;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CanteenController extends Controller
{
	/**
     * Show the cu canteen page.
     *
     * @return Response
     */
    public function index()
    {
        $all_shops = Shop::get();
        // print_r($all_shops);
        for ($i=0; $i < count($all_shops); $i++) { 
            $all_shops[$i]['rating'] = Shop::getShopRating($all_shops[$i]['shop_id']);
        }
        $data = array(
            'shops' => $all_shops,
            'location' => Shop::all()->pluck('shop_location'),
        );
        return view('canteen/home', $data);
    }

    /**
     * Get data for show the store page.
     *
     * @return Response json
     */
    public function show(Request $request, $id)
    {
        if (! $request->ajax()) {
            return response('Unauthorized.', 401);
        }

        $request->session()->put('shop', $id);

        $data = Shop::getShop($id);
        $data['rating'] = Shop::getShopRating($id);
        $data['comments'] = Comment::getCommentShop( );
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

        $comment = new Comment;
        $comment->comment_text = $request->input('comment');
        $comment->shop_id = $request->session()->get('shop'); // $request->input('shop_id')
        $comment->comment_rating = 1.0;
        $comment->user_id = 0;

        if (Auth::check())
        {
            // Get the currently authenticated user's ID...
            $comment->user_id = Auth::id();
        }

        return ($comment->save()) ? 'true' : 'false';;
    }

    private function toDistance($lat1, $lng1, $lat2, $lng2) {
        $rad1 = $lat1 * M_PI / 180;
        $rad2 = $lat2 * M_PI / 180;
        $diff_rad = ($lat2 - $lat1) * M_PI / 180;
        $diff_lam = ($lng2 - $lng1) * M_PI / 180;

        $a = sin($diff_rad/2) * sin($diff_rad/2) + cos($rad1) * cos($rad2) * sin($diff_lam/2) * sin($diff_lam/2);
        $c = 2 * atan2(sqrt(a), sqrt(1-a));

        return 6371000 * $c;
    }
}