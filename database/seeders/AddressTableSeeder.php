<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'addresses' ) -> insert(
        [
            "resource_id"                   => "548752300984",

            "customer_id"                   => 1,
            "type"                          => "delivery_address",
            "country"                       => "Ghana",
            "region"                        => "Greater Accra",
            "city"                          => "Accra",
            "street_name"                   => "#1, Liman Street, Ambassadorial Enclave",
            "postal_code"                   => "GT-825782424",

            "created_at"                    => date("Y-m-d H:i:s"),
            "updated_at"                    => date("Y-m-d H:i:s"),
        ]);
    }
}
