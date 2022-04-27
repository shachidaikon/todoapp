<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime; 

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('todos')->insert([
            'is_checked' => false,
            'title' => "hoge",
            'content' => "hogehoge",
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('todos')->insert([
            'is_checked' => false,
            'title' => "hoge2",
            'content' => "hogehoge2",
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);


        DB::table('todos')->insert([
            'is_checked' => false,
            'title' => "hoge3",
            'content' => "hogehoge3",
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
