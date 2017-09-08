<?php

use Illuminate\Database\Seeder;

class ShopsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_shop')->insert([
        	'shop_name' => str_random(10),
        	'shop_location' => str_random(10),
        	'shop_time' => date('Y-m-d H:i:s'),
        	'shop_lat' => random_float(-90, 90),
        	'shop_lng' => random_float(-180, 180),
        	'shop_description' => str_random(10),
        ]);
    }
}

function random_float ($min,$max) {
   return ($min+lcg_value()*(abs($max-$min)));
}