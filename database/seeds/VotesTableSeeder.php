<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vote = new App\Vote([
            'idea_id' => '2',
            'user_id' => '1'
        ]);
        $vote->save();
        $vote = new App\Vote(
        [
            'idea_id' => '1',
            'user_id' => '1'
        ]);
        $vote->save();
        $vote = new App\Vote(
        [
            'idea_id' => '2',
            'user_id' => '3'
        ]);
        $vote->save();
        $vote = new App\Vote(
        [
            'idea_id' => '2',
            'user_id' => '12'
        ]);
        $vote->save();
    }
}
