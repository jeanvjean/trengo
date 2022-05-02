<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    //posts seeder
        // for($i = 0; $i < 1000; $i++) {
        //     DB::table('posts')->insert([
        //         'title' => Str::random(10),
        //         'content' => Str::random(250),
        //         'category_id' => mt_rand(1,10),
        //         'views'=>mt_rand(1,100000),
        //         'average_rating'=>mt_rand(1,5),
        //         'created_at'=>now(),
        //         'updated_at'=>now()
        //     ]);
        // }
//categories seeder
        // for($i = 1; $i < 11; $i++) {
        //     DB::table('categories')->insert([
        //         'name' => Str::random(10),
        //         'created_at'=>now(),
        //         'updated_at'=>now()
        //     ]);
        // }
//likes seed
        // for($i = 0; $i < 100000; $i + 1) {
        //     DB::table('likes')->insert([
        //         'post_id'=> mt_rand(1,1000),
        //         'ip_address'=>mt_rand(100000000,999999999),
        //         'created_at'=>now(),
        //         'updated_at'=>now()
        //     ]);
        // }
//rating seed
        // for($i = 0; $i < 10000; $i + 1) {
        //     DB::table('ratings')->insert([
        //         'ip_address'=>mt_rand(100000000,999999999),
        //         'post_id'=>mt_rand(1,1000),
        //         'rate'=>mt_rand(1,5),
        //         'created_at'=>now(),
        //         'updated_at'=>now()
        //     ]);
        // }
    }
}
