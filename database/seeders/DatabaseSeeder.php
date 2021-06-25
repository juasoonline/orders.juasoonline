<?php

namespace Database\Seeders;

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
        $this -> call([ CountriesTableSeeder::class ]);
        $this -> call([ ShipperTableSeeder::class ]);
        $this -> call([ TransportTableSeeder::class ]);
        $this -> call([ CustomerTableSeeder::class ]);
        $this -> call([ AddressTableSeeder::class ]);
        $this -> call([ PaymentMethodTableSeeder::class ]);
    }
}
