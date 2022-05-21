<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Models\Vouchers;
use App\Models\Customers;
use App\Models\PurchaseTransaction;

class ApiController extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function eligibleCheck(Request $request)
  {
    $Transaction = PurchaseTransaction::where('customer_id',$request->customer_id)->where('transaction_at','>',now()->subDays(30)->endOfDay());
    $voucher = Vouchers::where('customer_id',$request->customer_id)->first();
    $voucherleft = Vouchers::whereNULL('customer_id')->count();

    //Check any Voucher left 
    if($voucherleft == 0)
    {
      return response()->json(['error' => 'All vouchers has been distributed'], 401);
    }
    if($Transaction->sum('total_spent') >= '100' && $Transaction->count('id') && !$voucher)
    {

      $voucher = Vouchers::whereNULL('customer_id')->first();
      $voucher->update([
        'customer_id'=>$request->customer_id,
        'expired_at'=>now()->addMinute(10),
      ]);
      return response()->json(['success' => 'success'], 200);
    }else{
      //return error
      return response()->json(['error' => 'Transaction volume less than 3 in 30 days or Total transactions less than $100'], 401);
    }
  }

  public function validatePhoto(Request $request)
  {
    //image recognition API
    $imageRecognition = rand(0,1);
    $voucher = Vouchers::where('customer_id',$request->customer_id)->first();

    //if image recognition return true and voucher not expired
    if($imageRecognition == 1 && $voucher->expired_at > now())
    {
      //return success with voucher
      return response()->json(['success' => 'success','voucher'=>$voucher->code], 200);
    }else{
      $voucher->update([
        'customer_id'=>NULL,
        'expired_at'=>NULL,
        'updated_at'=>NULL,
      ]);
      //return error
      return response()->json(['error' => 'Image recognition fail or Submission timeout'], 401);
    }

  }
}
