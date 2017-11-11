<?php 
namespace App\Http\Controllers\Canteen;

use App\User;
use App\EmailToken;
use App\Jobs\ProcessEmail;
use App\Mail\EmailVerification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller 
{
	public static function addAdmin()
	{
		$data = array(
			'username' => 'admin',
			'password' => 'admin',
			'email' => 'panukorn1400@naver.com',
			'role' => 'admin',
		);
		User::addUser($data);
		User::where('user_username', 'admin')->restore();
		return "Succeed";
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

	public function verify(Request $request, $user_id, $token) {
		if (EmailToken::checkToken($user_id, $token) == true)
		{
			$data = User::where('user_id', $user_id)->get()->first();
			return view('canteen/mails/verified', $data);	
		}
		
		return response('Unauthorized.', 401);
	}

	/**
     * Handle an authentication attempt.
     *
     * @return Response
     */
	private function signIn($request)
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

	private function signUp($request) {
		if (! $request->ajax()) {
            return response('Unauthorized.', 401);
        }

        $data = array(
        	'username' => $request->input('a'),
        	'password'=> $request->input('b'),
        	'email' => $request->input('c'),
        );

        $result = User::addUser($data);
        if($result['status'] == 'true') 
        	return ProcessEmail::dispatch(new EmailVerification($result['user']['user_id'], $data));
        
        unset($result['user']);
        return response()->json($result);
	}

	public function logOut(Request $request) {
        return $this->signOut($request);
    }

    private function signOut($request) {
        $request->session()->forget('logon');
		$request->session()->forget('uid');
		$request->session()->forget('un');
		$request->session()->forget('r');
		$request->session()->flush();
		return redirect('/');
    }

}
