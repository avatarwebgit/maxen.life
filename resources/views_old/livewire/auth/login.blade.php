
<div>
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($cellphone_login)
        @if($CellphoneConfirm)
            <livewire:auth.mobile-register :login_token="$login_token"/>
        @else
            <h3 style="font-size:22px" class="text-center text-muted">ورود با رمز پویا</h3>
            <div class="line"></div>
            <form wire:submit.prevent="confirm_mobile">
                <div class="mb-3">
                    <label class="form-label">شماره همراه:</label>
                    <input wire:model.deffer="cellphone" type="number" class="form-control">
                    @error('cellphone')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between">
                <button wire:loading.attr="disabled" wire:target="confirm_mobile" type="submit"
                        class="btn btn-rounded btn-blue d-flex justify-content-center align-center login-btn">
                        <span wire:loading.remove wire:target="confirm_mobile">
                            تایید
                        </span>
                    <span wire:loading wire:target="confirm_mobile">
                         <span class="loader"></span>
                         </span>
                </button>
                <button wire:click="$emitUp('login_with_user_name',true)"
                        class="btn btn-gold btn-rounded d-flex justify-content-center align-center" type="button">
                        <span>
                            ورود با رمز ثابت
                        </span>
                </button>
                </div>
                <div class="text-center mt-3">
                    <span wire:click="$emitUp('showRegisterFromEvent' , true)" style="cursor: pointer">حساب کاربری ندارید؟ <span style="color:#5c8097;border-bottom: 1px solid #5c8097 ">ثبت نام کنید</span></span>
                </div>
				<div class="text-center mt-3">
                            <span>ورود شما به معنای پذیرش <a href="https://profilesaze.com/page/policy" target="_blank">قوانین و مقررات</a> پروفیل سازه است.</span>
            	</div>
            </form>
        @endif
    @else
        <h3 style="font-size:22px" class="text-center text-muted">ورود با رمز ثابت</h3>
        <div class="line"></div>
        <form wire:submit.prevent="login">
            <div class="mb-3">
                <label class="form-label">شماره همراه:</label>
                <input type="number" wire:model.deffer="user_name" class="form-control">
                @error('email')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">رمز عبور:</label>
                <input wire:model.deffer="password" type="password" class="form-control">
                @error('password')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input wire:model.deffer="remember" type="checkbox" class="form-check-input">
                <label class="form-check-label">مرا به خاطر بسپار</label>
            </div>
            <div class="d-flex justify-content-between">
                <button wire:loading.attr="disabled" wire:target="login" type="submit"
                        class="btn  btn-blue d-flex justify-content-center align-center login-btn">
                        <span wire:loading.remove wire:target="login">
                            ورود
                        </span>
                    <span wire:loading wire:target="login">
                         <span class="loader"></span>
                         </span>
                </button>
                <button wire:click="$emitUp('login_with_user_name',true)"
                        class="btn  btn-gold d-flex justify-content-center align-center" type="button">
                        <span>
                         ورود با رمز پویا
                        </span>
                </button>
            </div>
            <div class="text-center mt-3">
                <span wire:click="$emitUp('showRegisterFromEvent' , true)" style="cursor: pointer">حساب کاربری ندارید؟ <span style="color:#5c8097;border-bottom: 1px solid #5c8097 ">ثبت نام کنید</span></span>
            </div>
			<div class="text-center mt-3">
                             <span>ورود شما به معنای پذیرش <a href="https://profilesaze.com/page/policy" target="_blank">قوانین و مقررات</a> پروفیل سازه است.</span>
            </div>
        </form>
    @endif

</div>
