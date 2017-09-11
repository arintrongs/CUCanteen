<?php

namespace App;

use App\Comment;
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

    public static function getFood($shop_id) {
        $result = self::where('shop_id', $shop_id)->get();

        $foods = array();
        foreach ($result as $food) {
            $tmp = array(
                'id' => $food['food_id'],
                'name' => $food['food_name'],
            );
            array_push($foods, $tmp);
        }
        return $foods;
    }

    /**
     * Update a food (new if it doesn't exist)
     *
     * @param form input array $data  (required: name, shop_id)
     * @var string, Failed, Food returned if successfully added a Food
     */

    public static function updateFood($shop_id, $data = null){
        if(array_key_exists('id', $data))
        {
            $food = self::where('food_id', $data['id']) -> first();
            if (array_key_exists('val', $data)) 
                $food['food_name'] = $data['val'];
            
            $food['shop_id'] = $shop_id;
            $food -> save();
            return $food;
        }
        else
        {
            $food = new Food;
            $food['food_name'] = $data['val'];
            $food['shop_id'] = $shop_id;
            $food -> save();
            return $food;
        }

        return "Failed";
    }

    /**
     * get poppular food from specified shop
     *
     * @param int $shop_id 
     * @param int $count number of shop to be obtained
     * @var int[] food_id (-1 if there is no food in that shop, )
     */
    public static function getPopular($shop_id = 0, $count = 1){
        return $query -> where("shop_id", $shop_id)
                        -> orderBy(count(Comment::where('food_id', $this->food_id) -> get()))
                        -> take($count) -> get();
    }

}
