<?php

namespace App\Http\Controllers\Canteen;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
	/**
     * Show the cu canteen page.
     *
     * @return Response
     */
    public function create($name, $email)
    {
        return DB::table('tb_user_profile')->insert([
        	'name' => $name,
        	'email' => $email,
        ]);
    }
}