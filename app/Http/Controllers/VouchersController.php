<?php

namespace App\Http\Controllers;

use App\Models\Vouchers;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

 class VouchersController extends Controller{

    public function getByCodeVoucher($code, Vouchers $vouchers){
      $vouchers = $vouchers->getDataVoucherByCode($vouchers, $code)->first();

      if(!$vouchers){
         abort(404);
      }

      return $vouchers;
    }

    public function getAll(Vouchers $vouchers){
      $vouchers = $vouchers->getDataVoucherAll($vouchers);

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

    public function update(Request $request, Vouchers $vouchers){
        $code = $request->input('code');
        $balance = $request->input('balance');

        $vouchers = $vouchers->getDataVoucherByCode($vouchers, $code);
        $vouchers = $vouchers->update(['balance' => $balance]);

        if(!$vouchers){
            return view('404');
        }else{
           $response  = [
              'status' => 200,
              'message' => 'data voucher updated'
           ];

           return view('success',  $response);
        }

    }

    public function delete(Request $request, Vouchers $vouchers){

        $code = $request->input('code');
        $vouchers = $vouchers->getDataVoucherByCode($vouchers, $code);
        $vouchers = $vouchers->delete();

        if(!$vouchers){
            return view('404');
        }else{
           $response  = [
              'status' => 200,
              'message' => 'data voucher code '.$code.' has been deleted'
           ];

           return view('success',  $response);
        }
    }

    public function uploadImage(Request $request){
        // open an image file
      //  $img = Image::make('public/foo.jpg');

        // now you are able to resize the instance
        //$img->resize(320, 240);

        // and insert a watermark for example
      //  $img->insert('public/watermark.png');

        // finally we save the image as a new file
      //  $img->save('public/bar.jpg');

      if($request->hasFile('image')){
        $image = $request->file('image');
        $filename = time(). "." .$image->getClientOriginalExtension();
        $location = 'images/';

        //dd(is_writable($location . $filename));

        //Image::make($image)->resize(200,200)->save($location);

        $image->move($location, $filename);

        return 'berhasil masuk '.$filename;
      }else{
        return 'fak';
      }

    }


}
