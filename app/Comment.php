<?php
//SQLSTATE[42S02]: Base table or view not found: 1146 Table 'canteen.user' doesn't exist (SQL: select tb_comment.*, tb_user_profile.`dispname`, tb_user_profile.`name` from tb_comment left join user on tb_comment.`user_id` = tb_user_profile.`user_id` where shop_id = 1 order by tb_comment.`comment_rating` desc limit 10)
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\User;
use App\Food;

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
    public static function getCommentShop($shop_id = 0, $count = 10){
    	if($shop_id != 0) {
            $comments = self::where('shop_id', $shop_id)
                ->leftJoin('tb_user', 'tb_comment.user_id', '=', 'tb_user.user_id')
                ->select('tb_comment.*', 'tb_user.user_dispname', 'tb_user.user_username')
                ->orderBy('tb_comment.comment_rating', 'desc')
                ->take($count)
                ->get();
        
                $data = array();
                foreach ($comments as $comment) {
                    $data[] = array(
                        'id' => $comment['comment_id'],
                        'name' => $comment['user_username'],
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
        if($data != null)
        {
            if (!$data['user_id']) return 'false';
            if (!$data['shop_id']) return 'false';
            if (!$data['rating'])  return 'false';
            if (!$data['food_id']) return 'false';
            if (!$data['comment']) return 'false';
            $comment = new Comment;
            
            $comment['user_id'] = $data['user_id'];
            $comment['shop_id'] = $data['shop_id'];
            $comment['comment_rating'] = $data['rating'];

            if (is_numeric($data['food_id']))
                $comment['food_id'] = $data['food_id'];
            else
            {
                $food = Food::updateFood($data['shop_id'], array('val' => $data['food_id']));
                $comment['food_id'] = $food['food_id'];
            }
            $comment['comment_text'] = $data['comment'];
            $comment->save();
            return 'true';
        }
        return 'false';
    }

    /**
     * Delete comment (Return True on succeed, else False)
     *
     * @var bool
     */
    public function deleteCommentShop($comment_id = 0)
    {
        if($comment_id != 0)
        {
            $comment = $this->where('comment_id',$comment_id)->get();
            if($comment == null) 
                return False;
            $comment -> forceDelete();
            return True;
        }
        

        return False;
    }



}
