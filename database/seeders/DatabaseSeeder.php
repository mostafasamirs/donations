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
        // \App\Models\User::factory(10)->create();
        $this->call(PermissionTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(KioskSeeder::class);
        $this->call(User_kioskSeeder::class);
        $this->call(ChairtySeeder::class);
        $this->call(DonatorSeeder::class);

        $this->call(DonationSeeder::class);
        $this->call(DepositSeeder::class);
        $this->call(ShiftSeeder::class);
        $this->call(CategorySeeder::class);

    }
}
