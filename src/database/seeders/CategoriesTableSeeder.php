<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['content' => '商品の交換について', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['content' => 'サービスの不具合', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['content' => 'その他', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
