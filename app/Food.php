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
     * @var String Food_name
     */
    public static function getPopular($shop_id = 0){
        $foods = self::where("shop_id",$shop_id)->pluck('food_id');
        $max = -1;
        $max_id = -1;
        foreach($foods as $food){
            $count = Comment::where(['shop_id' => $shop_id, 'food_id' => $food])->count();
            if($count > $max){
                $max = $count;
                $max_id = $food;
            }
        }

        if($max_id <= 0)
            return 'Not available.';

        return self::where('food_id',$max_id)->pluck('food_name')[0];
    }

}
