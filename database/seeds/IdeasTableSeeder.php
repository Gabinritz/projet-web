<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IdeasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idea = new App\Idea([
            'name' => 'AfterWork',
            'nominator' => 'Pierre Dumangin',
            'description' => 'Aller boire dans les bars de Strasbourg'
        ]);
        $idea->save();
        $idea = new App\Idea(
        [
            'name' => 'Faire un foot',
            'nominator' => 'Clément Acker',
            'description' => 'Faire un foot avec les tuteurs'
        ]);
        $idea->save();
        $idea = new App\Idea(
        [
            'name' => 'Tuto Cuisine',
            'nominator' => 'Corentin Nussbaum',
            'description' => 'Regardez mon tuto cuisine sur mon snap : coconus'
        ]);
        $idea->save();
    }
}
