<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'countries' ) -> insert([
            "resource_id"       =>  hexdec( uniqid() ),
            'name' => 'Ghana',
            'currency' => 'GHS',
            'phone_code' => '233',
            'iso_code' => 'GH',
            'number_code' => 'ISO 3166-2:GH',
        ]);
        DB::table( 'countries' ) -> insert([
            "resource_id"       =>  hexdec( uniqid() ),
            'name' => 'Nigeria',
            'currency' => 'NGN',
            'phone_code' => '234',
            'iso_code' => 'NG',
            'number_code' => '588',
        ]);
        DB::table( 'countries' ) -> insert([
            "resource_id"       =>  hexdec( uniqid() ),
            'name' => 'Kenya',
            'currency' => 'KES',
            'phone_code' => '254',
            'iso_code' => 'KE',
            'number_code' => 'ISO 3166-2:KE',
        ]);
    }
}
