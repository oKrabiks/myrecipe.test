<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeywordSeeder extends Seeder
{
    public function run()
    {
        DB::table('keywords')->insert([
            ['name' => 'Ātri'],
            ['name' => 'Vienkārši'],
            ['name' => 'Veselīgi'],
        ]);
    }
}