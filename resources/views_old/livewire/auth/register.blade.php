<div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            Go to <strong wire:click="$emitUp('showRegisterFromEvent' , false)" style="cursor: pointer">Login</strong> page.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

        @if($CellphoneConfirm)
            <livewire:auth.mobile-register :login_token="$login_token"/>
        @else
            <h3 style="font-size:22px" class="text-center text-muted">ثبت نام</h3>
            <div class="line"></div>
            <form wire:submit.prevent="register">
                <div class="mb-3">
                    <label class="form-label">نام:</label>
                    <input wire:model.lazy="first_name" type="text" class="form-control">
                    @error('first_name')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">نام خانوادگی:</label>
                    <input wire:model.lazy="last_name" type="text" class="form-control">
                    @error('last_name')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">شماره همراه:</label>
                    <input wire:model.lazy="cellphone" type="number" class="form-control">
                    @error('cellphone')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">رمز عبور:</label>
                    <input wire:model.lazy="password" type="password" class="form-control">
                    @error('password')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">تکرار رمز عبور:</label>
                    <input wire:model.lazy="passwordConfirm" type="password" class="form-control">
                    @error('passwordConfirm')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button wire:loading.attr="disabled" wire:target="register" type="submit" class="btn btn-rounded btn-blue d-flex justify-content-center align-center login-btn">
                <span wire:loading.remove wire:target="register">
                    ثبت نام
                </span>
                    <span wire:loading wire:target="register">
                <span class="loader"></span>
            </span>
                </button>
                <div class="text-center mt-3">
                    <span wire:click="$emitUp('showRegisterFromEvent' , false)" style="cursor: pointer">حساب کاربری دارید؟ <span style="color:#5c8097;border-bottom: 1px solid #5c8097 ">وارد شوید</span></span>
                </div>
                	<div class="text-center mt-3">
                             <span>ثبت نام شما به معنای پذیرش <a href="https://profilesaze.com/page/policy" target="_blank">قوانین و مقررات</a> پروفیل سازه است.</span>
            </div>
            </form>
        @endif
</div>
