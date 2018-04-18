<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ActivitiesTableSeeder::class);
        $this->call(VotesTableSeeder::class);
        $this->call(IdeasTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
    }
}
