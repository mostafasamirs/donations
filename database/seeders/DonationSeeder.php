<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Donation;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Donation::create([
            'user_id' => 1,
            'kiosk_id' => 1,
            'donator_id' => 1,
            // 'phone' => 1234,
            'amount' => 211.52,
            // 'date' => Carbon::create('4', '4', '1'),
          ]);
        Donation::create([
            'user_id' => 2,
            'kiosk_id' => 2,
            'donator_id' => 2,
            // 'phone' => 12345,
            'amount' => 211.52,
            // 'date' => Carbon::create('4', '4', '1'),
          ]);
        Donation::create([
            'user_id' => 3,
            'kiosk_id' => 3,
            'donator_id' => 3,
            // 'phone' => 12346,
            'amount' => 211.52,
            // 'date' => Carbon::create('4', '4', '1'),
          ]);
        Donation::create([
            'user_id' => 4,
            'kiosk_id' => 4,
            'donator_id' => 4,
            // 'phone' => 1234563,
            'amount' => 211.52,
            // 'date' => Carbon::create('4', '4', '1'),
          ]);
        Donation::create([
            'user_id' => 5,
            'kiosk_id' => 5,
            'donator_id' => 5,
            // 'phone' => 1234336563,
            'amount' => 211.52,
            // 'date' => Carbon::create('4', '4', '1'),
          ]);
    }
}
