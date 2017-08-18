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
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Primary key for this model. (Auto-Incrementing)
     *
     * @var int
     */
    public $primaryKey = 'comment_id'

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql';


    public function getCommentShop($shop_id = 0,$count = 10)
    {
    	$comments = $this->where('shop_id', $shop_id)
    	->leftJoin('user', 'tb_comment.user_id', '=', 'tb_user_profile.user_id')
    	->select('tb_comment.*', 'tb_user_profile.dispname', 'tb_user_profile.name')
    	->orderBy('tb_comment.comment_rating', 'desc')
    	->take($count)
        ->get();

        $data = array();
        foreach ($comments as $comment) {
		    $data[] = array(
                'id' => $comment['id'],
		    	'name' => $comment['name'],
		    	'comment' => $comment['comment_text'],
		    );
		}

		return $data;
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
