<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\User;

class Comment extends Model{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tb_comment';

    /**
     * define custom timestamp column
     *
     */
    const CREATED_AT = 'comment_timestamp';
    const UPDATED_AT = 'comment_timestamp';

    /**
     * Primary key for this model. (Auto-Incrementing)
     *
     * @var int
     */
    protected $primaryKey = 'comment_id';

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * Add comment 
     *
     *  
     * @var string, Failure Cause, "Succeed" returned if successfully added the comment
     */
    public static function addComment($data = null){
        if($data != null){
        	if(!array_key_exists('comment', $data))$data['comment'] = null;
        	if(!array_key_exists('food', $data))$data['food'] = null;
            if(self::where(['user_id' => $data['user_id'], 'shop_id' => $data['shop_id']])->first() != null)
            	$comment = self::where(['user_id' => $data['user_id'], 'shop_id' => $data['shop_id']])->first();
            else $comment = new Comment;
            $comment['user_id'] = $data['user_id'];
            $comment['shop_id'] = $data['shop_id'];
            $comment['comment_rating'] = $data['rating'];
            $comment['comment_text'] = $data['comment'];
            $comment['comment_food'] = $data['food'];
            $comment->save();
        }
        return "Succeed";
    }

    /**
     * Delete comment (Return True on succeed, else False)
     *
     * @var bool
     */
    public function deleteComment(){
        $comment = settype();
        if($comment == null) return False;
        return gettype($comment);
        if(gettype($comment)=='App\Comment'){
        	$comment -> delete();
            return True;
        }
        return False;
    }

    

}