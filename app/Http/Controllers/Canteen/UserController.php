<?php 
namespace App\Http\Controllers\Canteen;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

	    if (Auth::attempt(['user_username' => $request->input('a'), 'password' => $request->input('b')])) {
	        // Authentication passed...
	        $data = array(
	        	'success' => 'ok',
	        	'name' => Auth::user(),
	        );
	        return response()->json(array('success' => 'ok'));
	    }

	    return response()->json(array('success' => 'fail'));
	}

}
