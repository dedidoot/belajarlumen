<?php

namespace App\Http\Controllers;

use App\Models\Vouchers;
use Illuminate\Http\Request;

 class VouchersController extends Controller{

    public function get($code, Vouchers $vouchers){
      $vouchers = $vouchers->getDataVoucherByCode($vouchers, $code)->first();

      if(!$vouchers){
         abort(404);
      }

      return $vouchers;
    }

    public function insert(Request $request){

        $this->validate($request, [
            'code' => 'required',
            'balance' => 'required'
        ]);

        $code = $request->input("code");
        $balance = $request->input("balance");

        $voucher = new Vouchers([
          'code' => $code,
          'balance' => $balance
        ]);

        if($voucher->save()){

           $response  = [
              'status' => 201,
              'message' => 'data voucher created'
           ];

           return view('success',  $response);
        }else{
           return view('404');
        }

    }


}
