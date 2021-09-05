<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryFeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table( 'delivery_methods' ) -> insert(
//        [
//            "resource_id"                   => "548752300984",
//
//            "name"                          => "Free Delivery",
//            "description"                   => "No delivery charges and is within 48 hours",
//            "fee"                           => 0.00,
//
//            "created_at"                    => date("Y-m-d H:i:s"),
//            "updated_at"                    => date("Y-m-d H:i:s"),
//        ]);
        DB::table( 'delivery_methods' ) -> insert(
        [
            "resource_id"                   => "548752323484",

            "delivery_time"                 => "25-48 hours",
            "fee"                           => 15.00,
            "carrier"                       => "Juasoonline Standard Delivery",
            "description"                   => "",

            "created_at"                    => date("Y-m-d H:i:s"),
            "updated_at"                    => date("Y-m-d H:i:s"),
        ]);
        DB::table( 'delivery_methods' ) -> insert(
        [
            "resource_id"                   => "548752311909",

            "delivery_time"                 => "13-24 hours",
            "fee"                           => 35.00,
            "carrier"                       => "Juasoonline Express Delivery",
            "description"                   => "",

            "created_at"                    => date("Y-m-d H:i:s"),
            "updated_at"                    => date("Y-m-d H:i:s"),
        ]);
        DB::table( 'delivery_methods' ) -> insert(
        [
            "resource_id"                   => "548752301984",

            "delivery_time"                 => "Within 12 hours",
            "fee"                           => 50.00,
            "carrier"                       => "Juasoonline Premium Delivery",
            "description"                   => "",

            "created_at"                    => date("Y-m-d H:i:s"),
            "updated_at"                    => date("Y-m-d H:i:s"),
        ]);
    }
}
