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
        $project_status_voi         = App\ProjectStatus::create(['name' => 'verzoek om informatie']);
        $project_status_concept     = App\ProjectStatus::create(['name' => 'concept']);
        $project_status_definitief  = App\ProjectStatus::create(['name' => 'definitief']);
        $project_status_gesloten    = App\ProjectStatus::create(['name' => 'gesloten']);
    }
}
