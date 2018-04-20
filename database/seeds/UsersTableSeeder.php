<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new App\User([
            'name' => 'Dumangin',
            'firstname' => 'Pierre',
            'email' => 'pierre.dumangin@viacesi.fr',
            'password' => bcrypt('PierreD'),
            'status' => '0'
        ]);
        $user->save();
        $user = new App\User(
        [
            'name' => 'Nussbaum',
            'firstname' => 'Corentin',
            'email' => 'corentin.nussbaum@viacesi.fr',
            'password' => bcrypt('CorentinN'),
            'status' => '0'
        ]);
        $user->save();
        $user = new App\User(
        [
            'name' => 'Acker',
            'firstname' => 'Clément',
            'email' => 'clement.acker@viacesi.fr',
            'password' => bcrypt('clementA'),
            'status' => '1'
        ]);
        $user->save();
    }
}
