<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tb_user';

    /**
     * Overides original id
     *
     * @var int
     */
    protected $primaryKey = 'user_id';

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * define custom timestamp column
     *
     */
    const CREATED_AT = 'user_timestamp';
    const UPDATED_AT = 'user_timestamp';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_username', 'user_hpassword', 'user_studentid', 'user_fbid', 'user_dispname', 'user_disppict'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['user_hpassword', 'user_session', 'user_role'];


    /**
     * Scope a query by specific $type
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $type Role type
     * @return \Illuminate\Database\Eloquent\Builder 
     */
    public function scopeRole($query,$type)
    {
        return $query->where('user_role', $type);
    }

    /**
     * Add user 
     *
     * @param form input array $data  (required: username, password; optional: studentid, fbid, dispname, disppict)
     * @var string, Failure Cause, "Succeed" returned if successfully added an user
     */
    public static function addUser($data = null){
        $result = [
            'status' => false,
            'error' => 'Error: call method with null',
            'id' => 0,
        ];
        if($data != null)
        {
            if(count(self::where('user_username', $data['username'])->get()) != 0 || count(self::onlyTrashed()->where('user_username', $data['username'])->get()) != 0)
            {
                $result['error'] = "Error: user exist";
                return $result;
            }
            else 
            {
                $user = new User;

                $user['user_username'] = $data['username'];
                $user['user_dispname'] = $data['username'];
                
                $hash = Hash::make($data['password']);
                while(Hash::needsRehash($hash)){ 
                    $hash = Hash::make($data);
                }
                $user['user_hpassword'] = $hash;

                if(array_key_exists('studentid', $data)) 
                    $user['user_studentid'] = $data['studentid'];
                
                if(array_key_exists('fbid', $data)) 
                    $user['user_fbid'] = $data['fbid'];
                
                if(array_key_exists('dispname', $data)) 
                    $user['user_dispname'] = $data['dispname'];
                
                if(array_key_exists('disppict', $data))
                    $user['user_disppict'] = $data['disppict'];

                if(array_key_exists('role', $data))
                    $user['user_role'] = $data['role'];
                else
                    $user['user_role'] = 'guest';
                
                $user->save();
                $result = ['status' => true,
                            'user' => $user,
                        ];

                $user->delete();
                return $result;
            }
        }

        return $result;
    }

    /**
     * Update existing user 
     *
     * @param form input array $data  
     * @var string, Failure Cause, "Succeed" returned if successfully added an user
     */
    public static function updateUser($data = null){
        if($data != null){
            if(!array_key_exists('id', $data)) 
                return "Error: id is not given";
            if(count(self::where(['user_id' => $data['id'], 'user_username' => $data['username']])->get()) == 0) return "Error: user does not exist";
            else 
            {
                $user = self::where(['user_id' => $data['id'], 'user_username' => $data['username']])->first();

                $hash = Hash::make($data['password']);
                while(Hash::needsRehash($hash)){ 
                    $hash = Hash::make($data['password']);
                }

                if(!Hash::check($data['password'],$user['user_hpassword']))
                    return "Error: password mismatch";
                
                $user['user_hpassword'] = $hash;
                if(array_key_exists('studentid', $data)) 
                    $user['user_studentid'] = $data['studentid'];
                
                if(array_key_exists('fbid', $data)) 
                    $user['user_fbid'] = $data['fbid'];
                
                if(array_key_exists('dispname', $data)) 
                    $user['user_dispname'] = $data['dispname'];
                else 
                    $user['user_dispname'] = $data['username'];
                
                if(array_key_exists('new_password', $data))
                {
                    if(!array_key_exists('confirm_password', $data)) 
                        return "Error: please enter the same password in confirm password";
                    
                    if($data['new_password'] != $data['confirm_password']) 
                        return "Error: new password and confirmation password is mismatch";
                    
                    $hash = Hash::make($data['new_password']);
                    while(Hash::needsRehash($hash)){ 
                        $hash = Hash::make($data['new_password']);
                    }
                    $user['password'] = $hash;
                }

                $user->save();
                return "Succeed";
            }
        }
        return "Error: call method with null";
    }
}
