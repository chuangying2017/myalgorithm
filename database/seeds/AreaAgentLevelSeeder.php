<?php

use Illuminate\Database\Seeder;

class AreaAgentLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\AreaAgentLevelModel::class,20)->create();
    }
}
