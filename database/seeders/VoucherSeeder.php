<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Str;
class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=0; $i < 3000; $i++) {
          DB::table('vouchers')->insert([
            'code' => Str::random(10),
          ]);
        }
    }
}
