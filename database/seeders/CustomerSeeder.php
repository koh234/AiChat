<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Str;
use DB;
use Carbon\Carbon;

class CustomerSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    //
    for ($i=0; $i < 1000; $i++) {
      $randomGender= rand(0,1);
      DB::table('customers')->insert([
        'first_name' => Str::random(10),
        'last_name' => Str::random(10),
        'gender' =>  $randomGender ? 'male' : 'female',
        'date_of_birth' => date("Y-m-d H:i:s",rand( strtotime("Jan 01 1930"), strtotime("Dec 31 2016"))),
        'contact_number' => '9'.str_pad(mt_rand(1,9999999),7,'0',STR_PAD_LEFT),
        'email' => Str::random(10).'@gmail.com',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
    }
  }
}
