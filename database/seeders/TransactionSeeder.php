<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Str;
use DB;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
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
      $total_spent = rand(20, 500) / 10;
      DB::table('purchase_transaction')->insert([
        'customer_id' => rand(0,1000),
        'total_spent' => $total_spent,
        'total_saving' => $total_spent*0.1,
        'transaction_at' => date("Y-m-d H:i:s",rand( strtotime("Jan 01 2022"), strtotime("May 19 2022"))),
      ]);
    }
  }
}
