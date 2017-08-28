<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tb_user';

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
        if($data != null){
            if(self::where(['user_username' => $data['username']])->first() != null) return "Error: user exist";
            else $user = new User;
            $user['user_username'] = $data['username'];
            $hash = Hash::make($data['password']);
            
            while(Hash::needsRehash($hash)){ 
                $hash = Hash::make($data);
            }
            
            $user['user_hpassword'] = $hash;
            if(array_key_exists(studentid, $data)) $user['user_studentid'] = $data['studentid'];
            if(array_key_exists(fbid, $data)) $user['user_fbid'] = $data['fbid'];
            if(array_key_exists(dispname, $data)) $user['user_dispname'] = $data['dispname'];
            else $user['user_dispname'] = $data['username'];
            if(array_key_exists(disppict))$user['user_disppict'] = $data['disppict'];
            $user->save();
            return "Succeed";
        }
        return "Error: call method with null";
    }

    /**
     * Update existing user 
     *
     * @param form input array $data  
     * @var string, Failure Cause, "Succeed" returned if successfully added an user
     */
    // public static function updateUser($data = null){
    //     if($data != null){
    //         if(self::where(['user_id' => $data['id'], 'user_username' => $data['username'])->first() == null) return "Error: user does not exist";
    //         else $user = self::where(['user_id' => $data['id'], 'user_username' => $data['username'])->first() == null;
    //         if(!Hash::check($data['password'],$user['user_hpassword']))return "Error: password mismatch";
    //         $hash = Hash::make($data['password']);
            
    //         while(Hash::needsRehash($hash)){ 
    //             $hash = Hash::make($data);
    //         }
            
    //         $user['user_hpassword'] = $hash;
    //         if(array_key_exists(studentid, $data)) $user['user_studentid'] = $data['studentid'];
    //         if(array_key_exists(fbid, $data)) $user['user_fbid'] = $data['fbid'];
    //         if(array_key_exists(dispname, $data)) $user['user_dispname'] = $data['dispname'];
    //         else $user['user_dispname'] = $data['username'];
    //         $user['comment_text'] = $data['comment'];
    //         $user['comment_food'] = $data['food'];
    //         $user->save();
    //         return "Succeed";
    //     }
    //     return "Error: call method with null";
    // }
}
