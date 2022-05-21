<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vouchers extends Model
{
  use HasFactory;
  /**
  * The table associated with the model.
  *
  * @var string
  */

  protected $fillable = ['customer_id','expired_at','updated_at'];

}
