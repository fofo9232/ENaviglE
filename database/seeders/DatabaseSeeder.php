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
        $this->call(UserTableSeeder::class);
        \App\Models\User::factory(50)->create();
        $this->call(CurrenciesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);

        
    }
}
