<?php

namespace App\Http\Controllers\Canteen;

use App\Models\Comment;
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
        $recomment = array(
            array('name' => 'I-Canteen', 'img' => 'img/header.jpg', 'description' => 'test', 'value' => 1),
            array('name' => 'I-Canteen', 'img' => 'img/header.jpg', 'description' => 'test', 'value' => 2),
            array('name' => 'โรงอาหารอักษร', 'img' => 'img/header.jpg', 'description' => 'test', 'value' => 3),
        );
        $name = array(
            ['label' => "I-Canteen", 'value' => 1],
            ['label' => "โรงอาหารอักษร", 'value' => 2],
            ['label' => "Card title", 'value' => 3],
            ['label' => "javascript", 'value' => 4],
            ['label' => "asp", 'value' => 5],
            ['label' => "ruby", 'value' => 6],
        );
        $data = array(
            'recomment' => json_encode($recomment),
            'name' => json_encode($name),
        );
        
        return view('canteen/page', ['data' => $data]);
    }

    /**
     * Get data for show the store page.
     *
     * @return Response json
     */
    public function show(Request $request, $id)
    {
        $request->session()->put('shop', $id);

        $data = array(
            'img' => '#',
            'name' => 'ร้านไก่ทอด อักษร สาขา สอง',
            'description' => 'Test test test description',
            'comments' => Comment::getCommentShop( ),
        );
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
        $comment->shop_id = $request->session()->get('shop');
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