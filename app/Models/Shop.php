<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Shop extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tb_shop';

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * Get all shop picture (For making Background)
     * @var array
     */
    public function getAllPicture(){
        $shops = self::all()->get();
        
    }

    public function getShop($shop_id = 0)
    {
    	$shop = self::where('shop_id', $shop_id)->first();;

        $data = array(
        	'img' => $shop->shop_img,
        	'name' => $shop->shop_name,
            'description' => $shop->shop_description,
        );
		return $data;
    }

    /**
     * get average shop rating (return negative value on error)
     *
     * @var double
     */
    public function getShopRating($shop_id = 0){
        if($shop_id != 0){
            double $sum = 0;
            $comments = Comment::where('shop_id',$shop_id)->get();
            foreach ($comments as $comment){
                $sum += $comment['comment_rating'];
            }
            
            return $sum/count($comments);
        }

        return -1;
    }
}
