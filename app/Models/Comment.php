<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Comment extends Model{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    private $table = 'tb_comment';

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
    private $primaryKey = 'comment_id'

    /**
     * The connection name for the model.
     *
     * @var string
     */
    private $connection = 'mysql';

    /**
     * The connection name for the model.
     *
     * @var array of comment if succeed, false returned if there is an error
     */
    public function getCommentShop($shop_id = 0,$count = 10){
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
     * Delete comment (Return True on succeed, else False)
     *
     * @var bool
     */
    public function deleteComment($comment_id = 0){
        if($comment_id != 0){
            $comment = self::where('comment_id',$comment_id)->get();
            if($comment == null) return False;
            $comment -> forceDelete();
            return True;
        }
        else return False;
    }



}
