<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Brokastis'],
            ['name' => 'Pusdienas'],
            ['name' => 'Vakariņas'],
            ['name' => 'Deserti'],
        ]);
    }
}