<?php

namespace App\Http\Controllers\Canteen;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class ReCaptchaController extends Controller
{
    public function index(Request $request) {
		$url = 'https://www.google.com/recaptcha/api/siteverify';
		$data = array('secret' => '6Ld2zDYUAAAAAKlZw8f9koDsrjMjCfGtHO40mfuB', 'response' => $request['response']);

		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'POST',
		        'content' => http_build_query($data)
		    )
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);

		return $result;

	}
}
