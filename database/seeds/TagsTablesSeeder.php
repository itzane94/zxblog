<?php

use Illuminate\Database\Seeder;

class TagsTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            'name'=>'大数据'
        ]);
        DB::table('tags')->insert([
            'name'=>'php'
        ]);
        DB::table('tags')->insert([
            'name'=>'云计算'
        ]);
        DB::table('tags')->insert([
            'name'=>'区块链'
        ]);
        DB::table('tags')->insert([
            'name'=>'机器学习'
        ]);
    }
}
