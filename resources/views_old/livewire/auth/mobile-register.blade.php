<div>
    <h3 class="text-center text-muted">تایید شماره همراه</h3>
    <div class="line"></div>
    <form wire:submit.prevent="checkotp">
        <div class="form-group">
            <input onkeypress="return isNumberKey(event)" wire:model.lazy="otp" class="form-control"
                   type="number"
                   placeholder="رمز یکبار مصرف">
            @error('otp')
            <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <button  wire:loading.attr="disabled" wire:target="checkotp" class="btn d-flex justify-content-center align-center btn-blue login-btn btn-rounded  my-3">
                <span wire:loading.remove wire:target="checkotp" class="button-text">ورود</span>
              <span wire:loading wire:target="checkotp">
                         <span class="loader"></span>
                         </span>
            </button>
            <button wire:click="resendOtp" id="resendOTP" class="btn btn-primary btn-block w-100 my-3 mt-3 d-none" type="button">
                <span wire:loading.remove wire:target="refresh" class="button-text">
                    ارسال مجدد
                </span>
                <span wire:loading wire:target="refresh">
                    <span class="loader"></span>
                </span>
            </button>
            <div class="d-flex justify-content-between p-3 align-content-center mt-3">
                <span id="resendCodeDiv">ارسال مجدد کد </span>
                <span id="resendOTPTime">2:00</span>
            </div>
        </div>
    </form>
    @section('style')
        <style>
            .SMSLoginBox {
                display: block;
            }

            .text-right {
                text-align: right !important;
            }

            .mr-0 {
                margin-right: 0 !important;
            }

            #loginOTPForm {
                border: none !important;
                padding: 20px;
            }

            .input-error-validation {
                font-size: 9pt;
                color: red;
            }

            #checkOTPForm {
                border: none !important;
                padding: 20px;
            }

            #resendOTPTime {
                padding: 5px;
                border-radius: 50%;
            }

            .DefaultLogin {
                display: none;
            }

            .logo {
                margin-left: 0 !important;
            }

            .logo img {
                margin: 0 auto;
            }
        </style>
    @endsection
    {{--javaScript--}}

</div>
