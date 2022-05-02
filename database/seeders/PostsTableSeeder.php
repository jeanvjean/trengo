<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PostsTableFactory::class, 1000)->create();
        // for($i = 0; $i < 1000; i + 1) {
        //     DB::create([
        //         'title' => $this->faker->title(),
        //         'content' => $this->faker->words(),
        //         'category_id' => mt_rand(1,10),
        //         'views'=>mt_rand(1,100000)
        //     ]);
        // }
    }
}
