<?php

use Illuminate\Database\Seeder;

class StaticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\ProjectStatus::create(['priority' => 1, 'name' => 'Aangemaakt']);
        App\ProjectStatus::create(['priority' => 2, 'name' => 'verzoek om informatie']);
        App\ProjectStatus::create(['priority' => 3, 'name' => 'concept']);
        App\ProjectStatus::create(['priority' => 4, 'name' => 'definitief']);
        App\ProjectStatus::create(['priority' => 5, 'name' => 'gesloten']);
    }
}
