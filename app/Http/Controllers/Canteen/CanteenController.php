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
}