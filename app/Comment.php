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
     * The connection name for the model.
     *
     * @var array of comment if succeed, false returned if there is an error
     */
    public static function getCommentShop($shop_id = 0,$count = 10){
    	if($shop_id!=0){
            $comments = self::where('shop_id', $shop_id)
                ->leftJoin('user', 'tb_comment.user_id', '=', 'tb_user_profile.user_id')
                ->select('tb_comment.*', 'tb_user_profile.dispname', 'tb_user_profile.name')
                ->orderBy('tb_comment.comment_rating', 'desc')
                ->take($count)
                ->get();
        
                $data = array();
                foreach ($comments as $comment) {
                    $data[] = array(
                        'id' => $comment['comment_id'],
                        'name' => User::where('user_id',$comment['user_id'])->first()->user_dispname,
                        'comment' => $comment['comment_text'],
                        'rating' => $comment['comment_rating'],
                        'recommendedfood' => $comment['comment_food'],
                        'updatedat' => $comment['comment_timestamp'],
                    );
                }
        
                return $data;
        }

        //Default Comment
        $data[] = array(
            'id' => 0,
            'name' => 'none',
            'comment' => 'There is no comment on this shop.',
            'rating' => 5.0,
            'recommendedfood' => 'nothing',
            'updatedat' => '0000-00-00 00:00:00',
        );
        return $data;
    }

    /**
     * Add comment 
     *
     *  
     * @var string, Failure Cause, "Succeed" returned if successfully added the comment
     */
    public static function addComment($data = null){
        if($data != null){
            if(!array_key_exists('comment', $data))
                $data['comment'] = null;
            if(!array_key_exists('food', $data))
                $data['food'] = null;
            if(self::where(['user_id' => $data['user_id'], 'shop_id' => $data['shop_id']])->first() != null)
                $comment = self::where(['user_id' => $data['user_id'], 'shop_id' => $data['shop_id']])->first();
            else 
                $comment = new Comment;
            
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
