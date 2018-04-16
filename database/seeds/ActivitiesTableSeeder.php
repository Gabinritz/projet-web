<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activity = new App\Activity([
            'name' => 'Piscine',
            'description' => 'Emmenez vos maillot de bains !!!',
            'date' => '2018-04-08',
            'place' => 'Piscine de Lingolsheim',
            'imgUrl' => 'background.jpg',
            'price' => '3',
            'recurrent' => false
        ]);
        $activity->save();
        $activity = new App\Activity(
        [
            'name' => 'Médecin du Sommeil',
            'description' => 'Antoine va chez le médecin du sommeil car il dort en prosit',
            'date' => '2018-02-12',
            'place' => 'Hopital de Strasbourg',
            'imgUrl' => 'background.jpg',
            'price' => '5',
            'recurrent' => true
        ]);
        $activity->save();
        $activity = new App\Activity(
        [
            'name' => 'Barbecue',
            'description' => 'Barbecue entre exars pendant le stage',
            'date' => '2018-06-15',
            'place' => 'eXia Cesi Strasbourg',
            'imgUrl' => 'background.jpg',
            'price' => '7',
            'recurrent' => false
        ]);
        $activity->save();
        $activity = new App\Activity(
        [
            'name' => 'Evenement Petit pain',
            'description' => 'Un petit pain offert par personne pour la fin de l\'année',
            'date' => '2018-04-20',
            'place' => 'eXia Cesi Strasbourg',
            'imgUrl' => 'background.jpg',
            'price' => '1',
            'recurrent' => false
        ]);
        $activity->save();

    }
}
