<?php

use Illuminate\Database\Seeder;

class seeder_tb_comments extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_comment')->insert([
            'user_id' => 0,
            'shop_id' => 0,
            'comment_rating' => $this->random_float(0, 5),
            'comment_text' => 'testing system',
        ]);
    }

    protected function random_float ($min, $max) {
       return ($min+lcg_value()*(abs($max-$min)));
    }
}

