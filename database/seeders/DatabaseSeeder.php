<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
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
        $this->call(RoleSeeder::class);
        $this->call(PersonSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeed::class);
        $this->call(ProviderSeed::class);
        $this->call(EspecialidadSeeder::class);
        $this->call(ProductoSeed::class);
    }
}
