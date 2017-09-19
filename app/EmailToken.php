<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use App\User;

class EmailToken extends Model
{
    use SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'emailtoken';

    /**
     * Overides original id
     *
     * @var int
     */
    protected $primaryKey = 'email_id';

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
    const CREATED_AT = 'email_timestamp';
    const UPDATED_AT = 'email_timestamp';

	/**
     * add new token to confirm
     *
     * @param int user_id
     * @var string token to be sended by email
     */
    public static function addToken($user_id){
    	$query = self::where(['user_id' => $user_id]);
        if($query->count()) 
            $token = $query->first();
        else 
            $token = new EmailToken;
        $token['user_id'] = $user_id;
        
        $str = str_random(32);
        $hashed = Hash::make($str);
        while(Hash::needsRehash($hashed)){ 
            $hashed = Hash::make($data);
        }
        $token['token'] = $hashed;

        $token -> save();

        return $str . "  " . $token['token'];
    }

    /**
     * validate existed token
     *
     * @param int user_id
     * @var boolean false on token mismatch, else return true;
     */
    public static function checkToken($user_id, $token){
        $query = self::where(['user_id' => $user_id]) -> first();
        if($query != NULL){

            if(Hash::check($token, $query['token'])){
                $query->delete();
                User::onlyTrashed()
                    ->where('user_id', $user_id)
                    ->restore();
                return true;
            }
            else{
                return $token;
            }
        }

        return false;
    }
}
