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
     * Add new food (new s         hop if id is not given) 
     *
     * @param form input array $data  (required: name, location, picture; optional: id, time, description, lat, lng, isVeg, isHalal)
     * @var string, Failure Cause, "Succeed" returned if successfully added an user
     */


}
