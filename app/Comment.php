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
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql';

    public function get_comment_shop($shop_id = 0)
    {
    	$comments = $this->where('shop_id', $shop_id)
    	->leftJoin('user', 'tb_comment.user_id', '=', 'tb_user_profile.user_id')
    	->select('tb_comment.*', 'tb_user_profile.dispname', 'tb_user_profile.name')
    	->orderBy('tb_comment.comment_rating', 'desc')
    	->take(10)
        ->get();

        $data = array();
        foreach ($comments as $comment) {
		    $data[] = array(
		    	'name' => $comment['name'],
		    	'comment' => $comment['comment_text'],
		    );
		}

		return $data;
    }

}
