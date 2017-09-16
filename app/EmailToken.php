<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class EmailToken extends Model
{
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

	/**
     * add new token to confirm
     *
     * @param int user_id
     * @var string token to be sended by email
     */
    public function addToken($user_id){
    	$query = self::where(['user_id' => $user_id]);
        if($query->count()) 
            $token = $query[0];
        else 
            $token = new EmailToken;
        $token['user_id'] = $user_id;
        
        $str = str_random(32);
        $hashed = Hash::make($str);
        while(Hash::needsRehash($hashed)){ 
            $hashed = Hash::make($data);
        }

        $token['token'] = Hash::make($hashed);
        $token -> save();

        return $str;
    }

    /**
     * validate existed token
     *
     * @param int user_id
     * @var boolean false on token mismatch, else return true;
     */
    public function checkToken($user_id, $token){
        $query = self::where(['user_id' => $user_id]) -> first();
        if($query -> count() !=0 ){
            $str = $token;
            $hashed = Hash::make($str);
            while(Hash::needsRehash($hashed)){ 
                $hashed = Hash::make($data);
            }

            if(Hash::check($hashed, $query['token'])){
                $query->delete();
                return true;
            }
            else{
                $query->delete();
                return false;
            }
        }

        return false;
    }
}
