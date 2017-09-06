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
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'food_id';

    /**
     * The database timestamp appearance.
     *
     * @var string
     */
    public $timestamps = false;

    /**
     * Update a food (new if it doesn't exist)
     *
     * @param form input array $data  (required: name, shop_id)
     * @var string, Failure Cause, "Succeed" returned if successfully added an user
     */

    public static function updateFood($shop_id, $data = null){
        if(array_key_exists('id', $data))
        {
            $food = self::where('food_id', $data['id']) -> first();
            if (array_key_exists('val', $data)) 
                $food['food_name'] = $data['val'];
            
            $food['shop_id'] = $shop_id;
            $food -> save();
        }
        else
        {
            $food = new Food;
            $food['food_name'] = $data['val'];
            $food['shop_id'] = $shop_id;
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
    public static function getPopular($shop_id = 0, $count = 1){
        return $query -> where("shop_id",($shop_id == 0)?$this->shop_id:$shop_id)
                        -> orderBy(count(App\Comment::where('food_id',$this->food_id) -> get()))
                        -> take($count) -> get();
    }

}
