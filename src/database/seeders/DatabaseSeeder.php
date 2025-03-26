<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(CategoriesTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
    }
}
