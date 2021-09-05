<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShipperTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'shippers' ) -> insert(
        [
            "resource_id"       =>  "5487529584",

            "name"              =>  "Juasoonline Xpress Delivery",
            "doing_business_as" =>  "Juasoonline Xpress",

            "region"            =>  "Greater Accra",
            "city"              =>  "Accra",
            "address"           =>  "Lakeside Estate, Ashaley Botwe. Adenta",
            "postal_code"       =>  "GPS-9776984",

            "mobile_phone"      =>  "58275287842",
            "other_phone"       =>  "58275287841",

            "website"           =>  "http://juasoonlinexpress.com",
            "email"             =>  "info@juasoonlinexpress.com",

            "created_at"        => date("Y-m-d H:i:s"),
            "updated_at"        => date("Y-m-d H:i:s"),
        ]);
    }
}
