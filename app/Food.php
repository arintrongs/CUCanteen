<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tb_food';

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * Update a food (new if it doesn't exist)
     *
     * @param form input array $data  (required: name, shop_id)
     * @var string, Failure Cause, "Succeed" returned if successfully added an user
     */

    public static function addFood($data = null){
        if(array_key_exists('id', $data)){
            $food = self::where('food_id', $data['id']) -> first();
            if(array_key_exists('name', $data)) $food['food_name'] = $data['name'];
            if(array_key_exists('shop_id', $data)) $food['shop_id'] = $data['shop_id'];
            $food -> save();
        }else{
            $food = new Food;
            $food['food_name'] = $data['name'];
            $food['shop_id'] = $data['shop_id'];
            $food -> save();
        }

        return "Succeed";
    }

    /**
     * Update a food (new if it doesn't exist)
     *
     * @param form input array $data  (required: name, shop_id)
     * @var string, Failure Cause, "Succeed" returned if successfully added an user
     */

    public static function deleteFood($data = null){
        if(array_key_exists('id', $data)){
            $food = self::where('food_id', $data['id']) -> first();
            if(array_key_exists('name', $data)) $food['food_name'] = $data['name'];
            if(array_key_exists('shop_id', $data)) $food['shop_id'] = $data['shop_id'];
            $food -> save();
        }else{
            $food = new Food;
            $food['food_name'] = $data['name'];
            $food['shop_id'] = $data['shop_id'];
            $food -> save();
        }

        return "Succeed";
    }

    /**
     * get poppular food from specified shop
     *
     * @param int $shop_id 
     * @param int $count number of shop to be obtained
     * @var int[] food_id (-1 if there is no food in that shop, )
     */
    public function getPopular($shop_id = 0, $count = 1){
        return $query -> where("shop_id",($shop_id == 0)?$this->shop_id:$shop_id)
                        -> orderBy(count(App\Comment::where('food_id',$this->food_id) -> get()))
                        -> take($count) -> get();
    }

}
