<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
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
    public function delete_comment_shop($comment_id = 0)
    {
        if($comment_id != 0)
        {
            $comment = $this->where('comment_id',$comment_id)->get();
            if($comment == null) return False;
            $comment -> forceDelete();
            return True;
        }
        else return False;
    }

}
