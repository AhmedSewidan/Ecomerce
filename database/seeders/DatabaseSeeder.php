<?php

namespace Database\Seeders;

<<<<<<< HEAD
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

=======
>>>>>>> 88b59fffecc57da7a36944e1c00996fce5555674
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD
        $this->call([
            // CategorySeeder::class,
            // ProductSeeder::class,
            CountrySeeder::class,
            GovernorateSeeder::class,
            CitySeeder::class,
        ]);
=======
        $this->call(Categories::class);
>>>>>>> 88b59fffecc57da7a36944e1c00996fce5555674
    }
}
