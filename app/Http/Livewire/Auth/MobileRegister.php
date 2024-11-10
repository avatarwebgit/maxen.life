<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use App\Notifications\OTPSms;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class MobileRegister extends Component
{
    public $otp,$login_token;

    protected $listeners=['refresh'];

    public function checkotp(){
        $this->validate([
            'otp' => 'required|digits:6',
        ]);
        try {
            $user = User::where('login_token', $this->login_token)->firstOrFail();
            if ($user->otp == $this->otp) {
               $user->update(['cellphone_is_registered'=>1]);
                alert()->success('ورود با موفقیت انجام شد');
                auth()->login($user);
                return redirect()->route('home.redirects');
            } else {
                $this->emit('flashMessage','error','کد وارد شده صحیح نیست');
            }

        } catch (\Exception $ex) {
            return response(['errors' => $ex->getMessage()], 400);
        }

    }
    public function resendOtp(){
        try {
            $user = User::where('login_token', $this->login_token)->firstOrFail();
            $otp = mt_rand(100000, 999999);
            $this->login_token = Hash::make('werfsfs$%^FVD0248!{DC%');
            $user->update([
                'otp' => $otp,
                'login_token' => $this->login_token,
            ]);
            $user->notify(new OTPSms($otp));
            $this->emit('flashMessage','success','رمز یکبار مصرف مجددا برای شما ارسال شد');
            $this->emit('showTimerForResendOtp');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            $this->emit('flashMessage','error','مشکل در ارسال کد تایید');
            $this->emit('showResendCode');
        }
    }
    public function render()
    {
        return view('livewire.auth.mobile-register');
    }
}
