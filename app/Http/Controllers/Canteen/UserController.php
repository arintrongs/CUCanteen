<?php 
namespace App\Http\Controllers\Canteen;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;

class UserController extends Controller 
{
	public function addAdmin()
	{
		$data = array(
			'username' => 'admin',
			'password' => 'admin',
		);
		User::addUser($data);
		return [];
	}

	public static function check(Request $request)
	{
		if ($request->session()->get('logon') == 'true')
			return true;

		return false;
	}

	/**
     * Handle an authentication attempt.
     *
     * @return Response
     */
	public function authenticate(Request $request)
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

	        $data = array(
	        	'success' => 'ok',
	        	'name' => $tmp['user_dispname'],
	        );
	        return response()->json($data);
	    }

	    return response()->json(array('success' => 'fail'));
	}

}
