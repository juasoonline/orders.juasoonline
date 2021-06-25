<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'payment_methods' ) -> insert(
        [
            "resource_id"                   =>  "548752943123",

            "name"                          =>  "MTN Momo",
            "code"                          =>  "MTN",
            "description"                   =>  "Pay with MTN Mobile Money",
            "logo"                          =>  "https://assets.juasoonline.com/juasoonline/assets/images/payments/mtn-momo.png",

            "created_at"                    => date("Y-m-d H:i:s"),
            "updated_at"                    => date("Y-m-d H:i:s"),
        ]);
        DB::table( 'payment_methods' ) -> insert(
        [
            "resource_id"                   =>  "548752943124",

            "name"                          =>  "AirtelTigo Money",
            "code"                          =>  "ATL",
            "description"                   =>  "Pay with AirtelTigo Money",
            "logo"                          =>  "https://assets.juasoonline.com/juasoonline/assets/images/payments/airteltigo.jpeg",

            "created_at"                    => date("Y-m-d H:i:s"),
            "updated_at"                    => date("Y-m-d H:i:s"),
        ]);
        DB::table( 'payment_methods' ) -> insert(
        [
            "resource_id"                   =>  "548752943125",

            "name"                          =>  "Vodafone Cash",
            "code"                          =>  "VOD",
            "description"                   =>  "Pay with Vodafone Cash",
            "logo"                          =>  "https://assets.juasoonline.com/juasoonline/assets/images/payments/vodafonecash.png",

            "created_at"                    => date("Y-m-d H:i:s"),
            "updated_at"                    => date("Y-m-d H:i:s"),
        ]);
        DB::table( 'payment_methods' ) -> insert(
        [
            "resource_id"                   =>  "548752943126",

            "name"                          =>  "Visa",
            "code"                          =>  "VIS",
            "description"                   =>  "Pay with Visa Card",
            "logo"                          =>  "https://assets.juasoonline.com/juasoonline/assets/images/payments/visa.png",

            "created_at"                    => date("Y-m-d H:i:s"),
            "updated_at"                    => date("Y-m-d H:i:s"),
        ]);
        DB::table( 'payment_methods' ) -> insert(
        [
            "resource_id"                   =>  "548752943127",

            "name"                          =>  "MasterCard",
            "code"                          =>  "MAS",
            "description"                   =>  "Pay with Master Card",
            "logo"                          =>  "https://assets.juasoonline.com/juasoonline/assets/images/payments/mastercard.png",

            "created_at"                    => date("Y-m-d H:i:s"),
            "updated_at"                    => date("Y-m-d H:i:s"),
        ]);
    }
}
