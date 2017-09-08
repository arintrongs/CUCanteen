<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;
use App\Food;
use App\PicturePath;

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
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'shop_id';

    /**
     * Scope by isVeg (Does this shop has vegetarian food. Recommend to be used with App\Shop::all() ) 
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */ 
    public static function scopeVeg($query){
        return $query->where('shop_isVeg','1');
    }

    /**
     * Scope by isHalal 
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */ 
    public static function scopeHalal($query){
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
    public static function scopeDist($query, $lat, $lng, $ths){
    
        return $query -> whereRaw("($lat-shop_lat)*($lat-shop_lat) + ($lng-shop_lng)*($lng-shop_lng) <= $ths*$ths")
                    -> orderByRaw("($lat-shop_lat)*($lat-shop_lat) + ($lng-shop_lng)*($lng-shop_lng)", " DESC");
    }

    /**
     * get average shop rating
     *
     * @var double
     */
    public static function getShopRating($shop_id = 0){
        if ($shop_id == 0)
            return 0;
        $su = 0;
        $comments = Comment::where('shop_id',$shop_id)->pluck('comment_rating');
        if(count($comments)==0)return 0;
        foreach ($comments as $comment)
            $su += (double)$comment;           
        return $su/count($comments);
    }

    /**
     * get related shop name
     *
     * @var double
     */
    public static function getRelatedShop($name){
        $shops = self::all()->pluck('');
    }

    /**
     * Update shop (new shop if id is not given) 
     *
     * @param form input array $data  (required: name, location, picture; optional: id, time, description, lat, lng, isVeg, isHalal)
     * @var string, Failure Cause, "Succeed" returned if successfully added an user
     */
    public static function updateShop($data){
        // if(array_key_exists('picture', $data)){
        //     //Call API to upload picture and obtain new $_FILE
        //     $shop['shop_picture'] = $data['picture'];
        // }

        if(array_key_exists('id', $data) && $data['id'] != 0)
        {
            $shop = self::where('shop_id', $data['id'])->first();
            if(array_key_exists('name', $data))
                $shop->shop_name = $data['name'];
            if(array_key_exists('location', $data))
                $shop->shop_location = $data['location'];
            if(array_key_exists('lat', $data))
                $shop->shop_lat = $data['lat'];
            if(array_key_exists('lng', $data))
                $shop->shop_lng = $data['lng'];
            // if(array_key_exists('picture', $data))
            //     $shop->shop_picture = $data['picture'];
            if(array_key_exists('time', $data))
                $shop->shop_time = $data['time'];
            if(array_key_exists('description', $data))
                $shop->shop_description = $data['description'];

            // if(array_key_exists('picture', $data))
            //     PicturePath::where('shop_id', $data['id'])->addPic($data);

            if(array_key_exists('food', $data))
                self::saveFood($data['id'], $data['food']);

            $shop->shop_isVeg = (array_key_exists('isVeg', $data)) ? ($data['isVeg'] == "true") : 0;
            $shop->shop_isHalal = (array_key_exists('isHalal', $data)) ? ($data['isHalal'] == "true") : 0;
            return $shop -> save();
        }
        else
        {
            $shop = new Shop;
            $error = "";
            if(array_key_exists('name', $data))
                $shop['shop_name'] = $data['name'];
            else 
                $error .= "name, ";
            if(array_key_exists('location', $data))
                $shop['shop_location'] = $data['location'];
            else 
                $error .= "location, ";
            if(array_key_exists('lat', $data))
                $shop['shop_lat'] = $data['lat'];
            if(array_key_exists('lng', $data))
                $shop['shop_lng'] = $data['lng'];
            if(array_key_exists('time', $data))
                $shop['shop_time'] = $data['time'];
            if(array_key_exists('description', $data))
                $shop['shop_description'] = $data['description'];

            $shop->shop_isVeg = (array_key_exists('isVeg', $data)) ? ($data['isVeg'] == "true") : 0;
            $shop->shop_isHalal = (array_key_exists('isHalal', $data)) ? ($data['isHalal'] == "true") : 0;
            
            if($error != "") 
                return "Error: " . $error . "is/are missing";
            return $shop -> save();
        }
    }

    public static function saveFood($shop_id, $foods) {
        if (count($foods) <= 0) return;
        $food_key = [];
        foreach ($foods as $food)
        {
            array_push($food_key, $food['val']);
            Food::updateFood($shop_id, $food);
        }

        $old_foods = Food::where('shop_id', $shop_id)->get();
        foreach ($old_foods as $food) {
            if (!in_array($food['food_name'], $food_key))
                $food->delete();
            else
            {
                $key = array_search($food['food_name'], $food_key);
                unset($food_key[$key]);
            }
        }
    }
}
