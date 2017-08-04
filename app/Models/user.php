<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	protected $table = 'tb_user';
	protected $hidden = ['password', 'remember_token'];
	public $primaryKey = 'user_id';
	public $timestamps = false;

	public function getUser($id){
		return $this->has('id' ,'==', $id)->get();
	}

}
