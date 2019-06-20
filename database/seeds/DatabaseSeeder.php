<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'first_name' => 'Meneer',
            // 'suffix_name' => 'de',
            'last_name' => 'de Admin',
            'city' => 'Stellendam',
            'street' => 'Tiendeweg',
            'street_number' => '99',
            'zipcode' => '3251 NB',
            'email' => 'admin@admin.nl',
            'phone' => '0612345678',
            'password' => bcrypt('admin123'),
            'is_admin' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Dennis van Schie',
            'first_name' => 'Dennis',
            // 'suffix_name' => 'van',
            'last_name' => 'van Schie',
            'city' => 'Bellingwolde',
            'street' => 'Nieuwe Weg',
            'street_number' => '192',
            'zipcode' => '9695 EH',
            'email' => 'dennis@dennis.nl',
            'password' => bcrypt('admin123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('vehicles')->insert([
            'make' => 'Audi',
            'model' => 'R8',
            'mileage' => 3700,
            'license_plate' => 'SF186K',
            'year' => 2016,
            'color' => 'Wit',
            'state' => 'Gebruikt',
            'body_type' => 'Coupe',
            'apk_expiration' => '2020-09-02',
            'transmission' => 'Automaat',
            'gears' => 7,
            'engine_capicity' => 5204,
            'cylinders' => 10,
            'empty_weight' => 1530,
            'drive' => 'AWD',
            'fuel_type' => 'Benzine',
            'doors' => 2,
            'seats' => 2,
            'power' => 611,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('listings')->insert([
            'title' => 'Audi R8 V10 Plus te koop',
            'description' => 'Nette Audi, altijd binnen gestaan',
            'expiration_date' => Carbon::now()->addWeek(),
            'starting_price' => 210000,
            'user_id' => 1,
            'vehicle_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('images')->insert([
            'listing_id' => 1,
            'img_path' => 'audir8.jpg',
            'mainImage' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('vehicles')->insert([
            'make' => 'Audi',
            'model' => 'RS6',
            'state' => 'Nieuw',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('listings')->insert([
            'title' => 'Audi RS6 V8 Performance te koop',
            'description' => 'Nette Audi, altijd buiten gestaan',
            'starting_price' => 150000,
            'expiration_date' => Carbon::now()->addWeek(),
            'user_id' => 2,
            'vehicle_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('images')->insert([
            'listing_id' => 2,
            'img_path' => 'audirs6.jpg',
            'mainImage' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
