<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new App\Product([
            'name' => 'Carotte',
            'price' => '2',
            'description' => 'Carotte du jardin',
            'category' => 'légume',
            'stock' => '5',
            'soldnumber' => '12',
            'imgUrl' => 'background.jpg'
        ]);
        $product->save();
        $product = new App\Product([
            'name' => 'Salade',
            'price' => '3',
            'description' => 'Salade du jardin',
            'category' => 'légume',
            'stock' => '5',
            'soldnumber' => '12',
            'imgUrl' => 'background.jpg'
        ]);
        $product->save();
        $product = new App\Product([
            'name' => 'Navet',
            'price' => '1',
            'description' => 'Navet du jardin',
            'category' => 'légume',
            'stock' => '5',
            'soldnumber' => '12',
            'imgUrl' => 'background.jpg'
        ]);
        $product->save();
        $product = new App\Product([
            'name' => 'Poireau',
            'price' => '2',
            'description' => 'Poireau du jardin',
            'category' => 'légume',
            'stock' => '5',
            'soldnumber' => '12',
            'imgUrl' => 'background.jpg'
        ]);
        $product->save();
    }
}
