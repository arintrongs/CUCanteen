<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function get_shop($shop_id = 0)
    {
    	$shop = $this->where('shop_id', $shop_id)->first();;

        $data = array(
        	'img' => $shop->shop_img,
        	'name' => $shop->shop_name,
            'description' => $shop->shop_description,
        );
		return $data;
    }
}
