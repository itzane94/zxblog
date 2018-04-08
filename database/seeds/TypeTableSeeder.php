<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('types')->insert([
            'name'=>'生活感悟',
            'pid'=>'0'
        ]);
        DB::table('types')->insert([
            'name'=>'PHP',
            'pid'=>'0'
        ]);

    }
}
