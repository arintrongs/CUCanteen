<?php 
namespace App\Http\Controllers\Canteen;

use App\User;
use App\Mail\EmailVerification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Facades\Auth;

class UserController extends Controller 
{
	public static function addAdmin()
	{
		$data = array(
			'username' => 'admin',
			'password' => 'admin',
			'role' => 'admin',
		);
		return User::addUser($data);
	}

	public static function check(Request $request)
	{
		if ($request->session()->get('logon') == 'true')
			return true;

		return false;
	}

	public static function isAdmin(Request $request)
	{
		if (self::check($request))
			if ($request->session()->get('r') == 'admin')
				return true;

		return false;
	}

	public function index(Request $request) {
		if ($request->input('action') == 'signin')
			return $this->signIn($request);
		else if ($request->input('action') == 'signup')
			return $this->signUp($request);
		else if ($request->input('action') == 'signout')
			return $this->signOut($request);
		else
			return response('Unauthorized.', 404);
	}

	/**
     * Handle an authentication attempt.
     *
     * @return Response
     */
	public function signIn($request)
	{
		if (! $request->ajax()) {
            return response('Unauthorized.', 401);
        }

        $tmp = User::where('user_username', $request->input('a'))->first();

        if (count($tmp) > 1)
        	return response()->json(array('success' => 'fail'));

	    if (Hash::check($request->input('b'), $tmp['user_hpassword'])) {
	        // Authentication passed...
	        $request->session()->put('logon', 'true');
	        $request->session()->put('uid', $tmp['user_id']);
	        $request->session()->put('un', $tmp['user_dispname']);
	        $request->session()->put('r', $tmp['user_role']);

	        $data = array(
	        	'success' => 'ok',
	        	'name' => $tmp['user_dispname'],
	        );
	        return response()->json($data);
	    }

	    return response()->json(array('success' => 'fail'));
	}

	public function signUp($request) {
		if (! $request->ajax()) {
            return response('Unauthorized.', 401);
        }

        $data = array(
        	'username' => $request->input('a'),
        	'password'=> $request->input('b'),
        	'email' => $request->input('c'),
        );

        $result = User::addUser($data);
        if($result == 'Succeed') 
        	$this->sendEmail($data);
        
        return response()->json(array('result' => $result));
	}

	public function signOut($request) {
        $request->session()->forget('logon');
		$request->session()->forget('uid');
		$request->session()->forget('un');
		$request->session()->forget('r');
		$request->session()->flush();
		return response()->json(array('success' => 'ok'));
    }

    private function sendEmail($data) {
    	Mail::to($data['email'])->send(new EmailVerification($data));
    }

}
