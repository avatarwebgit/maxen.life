<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Page;
use Illuminate\Support\Facades\Mail;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Mail\sendemailcontact;
use Illuminate\Support\Facades\Log;


class ContactController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $page = Page::find(2);
        return view('home.contact', compact('setting', 'page'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);
        try {
            ContactUs::create([
                'username' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
            ]);
            // Mail::send(new sendemailcontact($request->all()));
           alert()->success('پیام ارزشمند شما ثبت گردید','با تشکر')->autoclose('3000');
        } catch (\Exception $exception) {
            Log::error('contact_us_form_error:'.$exception->getMessage());
            dd($exception->getMessage());
            alert()->error('متاسفانه در ارسال پیام مشکلی رخ داده است')->persistent('ok');
        }
        return redirect()->back();
    }
}
