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
    protected $primaryKey = 'comment_id'

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
    public function getCommentShop($shop_id = 0,$count = 1){
    	if($shop_id!=0){
            $comments = self::where('shop_id', $shop_id)
                ->leftJoin('tb_user', 'tb_comment.user_id', '=', 'tb_user.user_id')
                ->select('tb_comment.*', 'tb_user.user_dispname', 'tb_user.name')
                ->orderBy('tb_comment.comment_timestamp', 'desc')
                ->take($count)
                ->get();
        
                $data = array();
                foreach ($comments as $comment) {
                    $data[] = array(
                        'id' => $comment['comment_id'],
                        'name' => $comment['user_dispname'],
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
     * @var bool False on failure
     */
    // public function addComment($data = null){
    //     if($data != null){
    //         $comment = new self(array(
    //             'user_id' => DatabaseUserProvider::
    //             ));
    //     }
    //     return False;
    // }

    /**
     * Delete comment (Return True on succeed, else False)
     *
     * @var bool
     */
    public function deleteComment($comment_id = 0){
        if($comment_id != 0){
            $comment = self::where('comment_id',$comment_id)->first();
            if($comment == null) return False;
            $comment -> forceDelete();
            return True;
        }
        else return False;
    }



}
