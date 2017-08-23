<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;

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
     * Scope by isVeg (Does this shop has vegetarian food. Recommend to be used with App\Shop::all() ) 
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */ 
    public function scopeVeg($query){
        return $query->where('shop_isVeg','1');
    }

    /**
     * Scope by isHalal 
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */ 
    public function scopeHalal($query){
        return $query->where('shop_isHalal','1');
    }

    /**
     * Scope by location and distance
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param double $lat
     * @param double $lng
     * @param double $ths (threshold)
     * @return \Illuminate\Database\Eloquent\Builder
     */ 
    public function scopeDist($query, $lat, $lng, $ths){
        return $query->whereRaw("($lat-shop_lat)*($lat-shop_lat) + ($lng-shop_lng)*($lng-shop_lng) <= $ths*$ths");
    }

    /**
     * get average shop rating (return zero on error)
     *
     * @var double
     */
    public function getShopRating($shop_id = 0){
        $su = 0;
        if($shop_id != 0){
            $comments = Comment::where('shop_id',$shop_id)->pluck('comment_rating');
            if(count($comments)==0)return 0;
            foreach ($comments as $comment){
                $su += (double)$comment;
            }
            
            return $su/count($comments);
        }

        return 0;
    }

    /**
     * Update shop (new shop if id is not given) 
     *
     * @param form input array $data  (required: name, location, picture; optional: id, time, description, lat, lng, isVeg, isHalal)
     * @var string, Failure Cause, "Succeed" returned if successfully added an user
     */
    public static function addShop($data){
        if($data['id'] != 0){
            $shop = Shop::where('shop_id',$data['id']);
            if(array_key_exists(name, $data))$shop['shop_name'] = $data['name'];
            if(array_key_exists(location, $data))$shop['shop_location'] = $data['location'];
            if(array_key_exists(lat, $data))$shop['shop_lat'] = $data['lat'];
            if(array_key_exists(lng, $data))$shop['shop_lng'] = $data['lng'];
            if(array_key_exists(picture, $data))$shop['shop_picture'] = $data['picture'];
            if(array_key_exists(time, $data))$shop['shop_time'] = $data['time'];
            if(array_key_exists(description, $data))$shop['shop_description'] = $data['description'];
            $shop['shop_isVeg'] = (array_key_exists(isVeg, $data))?$data['isVeg']:0;
            $shop['shop_isHalal'] = (array_key_exists(isHalal, $data))?$data['isHalal']:0;
            $shop -> save();
        }

        else{
            $shop = new Shop;
            $error = "";
            if(array_key_exists(name, $data))$shop['shop_name'] = $data['name'];
            else $error += "name, ";
            if(array_key_exists(location, $data))$shop['shop_location'] = $data['location'];
            else $error += "location, ";
            if(array_key_exists(lat, $data))$shop['shop_lat'] = $data['lat'];
            if(array_key_exists(lng, $data))$shop['shop_lng'] = $data['lng'];
            if(array_key_exists(picture, $data))$shop['shop_picture'] = $data['picture'];
            else $error += "picture, ";
            if(array_key_exists(time, $data))$shop['shop_time'] = $data['time'];
            if(array_key_exists(description, $data))$shop['shop_description'] = $data['description'];
            $shop['shop_isVeg'] = (array_key_exists(isVeg, $data))?$data['isVeg']:0;
            $shop['shop_isHalal'] = (array_key_exists(isHalal, $data))?$data['isHalal']:0;
            if($error != "") return "Error: " + $error + "is/are missing";
            $shop -> save();
        }
    }

}
