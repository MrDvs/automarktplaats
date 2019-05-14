<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicles')->insert([
            'listing_id' => 1,
            'make' => 'Audi',
            'model' => 'R8',
        ]);

        DB::table('listings')->insert([
            'img_path' => 'img/audir8.jpg',
            'title' => 'Audi R8 V10 Plus te koop',
            'description' => 'Nette Audi, altijd binnen gestaan',
            'starting_price' => 210000,
        ]);

        DB::table('vehicles')->insert([
            'listing_id' => 2,
            'make' => 'Audi',
            'model' => 'R8',
        ]);

        DB::table('listings')->insert([
            'img_path' => 'img/audirs6.jpg',
            'title' => 'Audi RS6 V8 Performance te koop',
            'description' => 'Nette Audi, altijd buiten gestaan',
            'starting_price' => 150000,
        ]);
    }
}
