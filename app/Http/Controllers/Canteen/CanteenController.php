<?php

namespace App\Http\Controllers\Canteen;

use App\Http\Controllers\Controller;
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
            array('name' => 'I-Canteen', 'img' => 'img/header.jpg', 'description' => 'test'),
            array('name' => 'I-Canteen', 'img' => 'img/header.jpg', 'description' => 'test'),
            array('name' => 'โรงอาหารอักษร', 'img' => 'img/header.jpg', 'description' => 'test'),
        );
        $name = array("I-Canteen", "โรงอาหารอักษร", "Card title", "javascript", "asp", "ruby");
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
    public function show( $id )
    {
        $data = array(
            'img' => '#',
            'name' => 'ร้านไก่ทอด อักษร สาขา สอง',
            'description' => 'Test test test description',
            'comments' => array( ), //get_comment_shop
        );
        $data['comments'] = array(
            array(
                'name' => '1234',
                'comment' => 'น่าเบื่อ',
            ),
            array(
                'name' => '1234',
                'comment' => 'น่าเบื่อ',
            ),
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
        $comment = $request->input('comment');

        return response()->json(array('Response' + $comment));
    }
}