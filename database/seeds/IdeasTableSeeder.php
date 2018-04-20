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
            'user_id' => 2,
            'description' => 'Aller boire dans les bars de Strasbourg'
        ]);
        $idea->save();
        $idea = new App\Idea(
        [
            'name' => 'Faire un foot',
            'user_id' => 3,
            'description' => 'Faire un foot avec les tuteurs'
        ]);
        $idea->save();
        $idea = new App\Idea(
        [
            'name' => 'Tuto Cuisine',
            'user_id' => 1,
            'description' => 'Regardez mon tuto cuisine sur mon snap : coconus'
        ]);
        $idea->save();
    }
}
