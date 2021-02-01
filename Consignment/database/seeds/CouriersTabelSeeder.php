<?php

use App\Courier;
use Illuminate\Database\Seeder;

class CouriersTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['code'=>'jne','title' => 'JNE'],
            ['code'=>'pos','title' => 'POS'],
            ['code'=>'tiki','title' => 'TIKI'],
        ];
        Courier::insert($data);
    }
}
