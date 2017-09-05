<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PicturePath extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tb_picturepath';

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql';

    public function addPic($data){
    	$pic = new PicturePath;
    	$basepath = "" //Your server path
    	$pic['shop_id'] = $data['id'];
    	$pic['shop_picturepath'] = $basepath.$_FILE['userfile']['tmp_name'];
    	$pic -> save();
    }
}
