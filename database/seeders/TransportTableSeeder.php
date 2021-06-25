<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'transports' ) -> insert(
        [
            "resource_id"                   =>  uniqid(),
            "shipper_id"                    =>  1,

            "name"                          =>  "Royal 456 Motorbike",
            "registration_number"           =>  "GT-4598 2021",

            "created_at"                    => date("Y-m-d H:i:s"),
            "updated_at"                    => date("Y-m-d H:i:s"),
        ]);
        DB::table( 'transports' ) -> insert(
        [
            "resource_id"                   =>  uniqid(),
            "shipper_id"                    =>  1,

            "name"                          =>  "Royal 326 Motorbike",
            "registration_number"           =>  "GT-9672 2021",

            "created_at"                    => date("Y-m-d H:i:s"),
            "updated_at"                    => date("Y-m-d H:i:s"),
        ]);
    }
}
