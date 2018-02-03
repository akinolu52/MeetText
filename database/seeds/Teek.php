<?php

use Illuminate\Database\Seeder;
use App\User;

class Teek extends Seeder
{

    function __construct()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 50)->create();
        factory(App\Task::class, 50)->create();
    }
}
