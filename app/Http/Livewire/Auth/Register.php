<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use App\Notifications\OTPSms;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Register extends Component
{
    public $CellphoneConfirm = false;
    public $first_name,$last_name, $cellphone, $password, $passwordConfirm,$login_token,$otp;
    protected $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'cellphone' => 'required|iran_mobile|unique:users',
        'password' => 'required|same:passwordConfirm',
    ];
    public function register()
    {
        $this->validate();
        try {
            $this->otp = mt_rand(100000, 999999);
            $this->login_token = Hash::make('werfsfs$%^FVD0248!{DC%');
            $user = User::Create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'user_name' => $this->cellphone,
                'cellphone' => $this->cellphone,
                'password' => Hash::make($this->password),
                'otp' => $this->otp,
                'login_token' => $this->login_token
            ]);
            $this->CellphoneConfirm = true;
            try {
                $user->notify(new OTPSms($this->otp));
                $this->emit('flashMessage','success','کد تایید فرستاده شده به '.$this->cellphone.' را وارد نمایید');
                $this->emit('showTimerForResendOtp');
            }catch (\Exception $exception){
                Log::error($exception->getMessage());
                $this->emit('flashMessage','error','مشکل در ارسال کد تایید');
            }
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            $this->emit('flashMessage','error','مشکل در ارسال کد تایید');
        }
    }


    public function render()
    {
        return view('livewire.auth.register');
    }
}
