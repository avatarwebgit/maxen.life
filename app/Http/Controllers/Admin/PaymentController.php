<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethods;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function paymentMethod()
    {
        $paymentMethods = PaymentMethods::where('is_show',1)->orderby('priority','asc')->paginate(8);
        return view('admin.setting.payment.paymentMethods', compact('paymentMethods'));
    }

    public function changeStatus(PaymentMethods $payment,$status)
    {
        $newStatus=$status==1 ? 0 : 1 ;
        $payment->update([
            'is_active'=>$newStatus,
        ]);
        alert()->success('وضعیت درگاه با موفقیت تغییر کرد', 'باتشکر');
        return redirect()->back();
    }
    public function config(PaymentMethods $payment)
    {
        return view('admin.setting.payment.config', compact('payment'));
    }

    public function edit(Request $request,PaymentMethods $payment){
        $request->validate([
            'image' => 'nullable|mimes:jpg,jpeg,png,svg',
            'merchantID' => 'nullable',
            'terminalId' => 'nullable',
            'userName' => 'nullable',
            'userPassword' => 'nullable',
            'deposit_percent' => 'nullable',
            'description' => 'nullable|string:60000',
            'description2' => 'nullable|string:60000',
            'short_description' => 'nullable|string:255',
            'priority' => 'required',
            'title' => 'required',
        ]);
        if ($request->has('image')){
            $productImageController = new ProductImageController();
            $Image = $productImageController->logoUpload($request->image);
            $path=public_path(env('LOGO_UPLOAD_PATH').$payment->image);
            if (file_exists($path) & !is_dir($path)){
                unlink($path);
            }
        }else{
            $Image=$payment->image;
        }
        $payment->update([
            'image'=>$Image,
            'merchantID'=>$request->merchantID,
            'terminalId'=>$request->terminalId,
            'userName'=>$request->userName,
            'userPassword'=>$request->userPassword,
            'deposit_percent'=>$request->has('deposit_percent') ? $request->deposit_percent :0,
            'description'=>$request->description,
            'description2'=>$request->description2,
            'short_description'=>$request->short_description,
            'priority'=>$request->priority,
            'title'=>$request->title,
        ]);
           if ($request->has('payment')){



                $payment->update([
                  'method'=>$request->payment,
                ]);

        }
        alert()->success('ویرایش با موفقیت انجام شد','با تشکر');
        return redirect()->route('admin.paymentMethods');
    }
}
