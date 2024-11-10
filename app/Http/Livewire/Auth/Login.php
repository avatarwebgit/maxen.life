<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use App\Notifications\OTPSms;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Login extends Component
{
    public $cellphone_login = true;
    public $CellphoneConfirm = false;
    public $login_token = null;
    public $name, $cellphone, $user_name, $password, $passwordConfirm, $remember;
    protected $listeners = ['login_with_user_name'];

    public function login(){
       
        $this->validate([
            'user_name' => 'required',
            'password' => 'required',
        ]);
        $user=User::where('cellphone',$this->user_name)->first();
        if ($user!=null){
            $cellphone_is_registered=$user->cellphone_is_registered;
            if ($cellphone_is_registered==1){
                if (Hash::check($this->password, $user->password)) {
                    auth()->loginUsingId($user->id);
                    alert()->success('ورود با موفقیت انجام شد');
                    return redirect()->route('home.redirects');
                }else {
                session()->flash('error', 'شماره همراه  یا رمز ورود اشتباه است');
                }
            }else{
                $this->cellphone_login=true;
                $this->CellphoneConfirm=true;
                $this->emit('flashMessage', 'success','برای تکمیل ثبت نام شماره همراه خود را تایید نمایید');
                $this->send_otp($user);
            }
        }else{
            $this->emit('flashMessage', 'error','کاربر یافت نشد');
        }

    }

    public function login_with_user_name()
    {
        $this->cellphone_login = !$this->cellphone_login;
    }

    public function confirm_mobile()
    {
        $this->validate([
            'cellphone' => 'required',
        ]);
        $user = User::where('cellphone', $this->cellphone)->first();
        $this->send_otp($user);
    }

    public function render()
    {
        return view('livewire.auth.login');
    }

    /**
     * @return void
     */
    public function send_otp($user): void
    {
        try {
            $this->otp = mt_rand(100000, 999999);
            $this->login_token = Hash::make('werfsfs$%^FVD0248!{DC%');
            if ($user) {
                $user->update([
                    'otp' => $this->otp,
                    'login_token' => $this->login_token
                ]);
                $this->CellphoneConfirm = true;
                try {
                    $user->notify(new OTPSms($this->otp));
                    $this->emit('flashMessage', 'success', 'کد تایید فرستاده شده به ' . $user->cellphone . ' را وارد نمایید');
                    $this->emit('showTimerForResendOtp');
                } catch (\Exception $exception) {
                    Log::error($exception->getMessage());
                    $this->emit('flashMessage', 'error', 'مشکل در ارسال کد تایید');
                }
            } else {
                $this->emit('flashMessage', 'error', 'کاربر یافت نشد');
            }

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            $this->emit('flashMessage', 'error', 'مشکل در ارسال کد تایید');
        }
    }
}
