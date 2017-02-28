<?php

use Illuminate\Database\Seeder;
use Mockery\Generator\factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\User::class, 5)->create();
        factory(App\Post::class, 10)->create();
    }
}
