<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vouchers extends Model{

  protected $fillable = [
      'code', 'balance',
  ];

  public function getDataVoucherByCode($query, $code){
    return $query->where('code', $code);
  }

  public function getDataVoucherAll($query){
    return $query->all();
  } 



}
