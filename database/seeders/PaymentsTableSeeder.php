<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
           'payment_name' => 'Stripe',
            'is_available' => true,
            'public_key' => '',
            'secret_key' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
