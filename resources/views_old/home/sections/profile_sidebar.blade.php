<div class="myaccount-tab-menu nav" role="tablist">
    @php
        $user=\Illuminate\Support\Facades\Auth::user();
        $path=public_path(env('USER_IMAGES_UPLOAD_PATH').$user->avatar);
        if (file_exists($path) and !is_dir($path)){
            $src=asset(env('USER_IMAGES_UPLOAD_PATH').$user->avatar);
        }else{
            $src=asset('/home/images/user.png');
        }
    @endphp
    <div>
        <button id="mobile_menu_nav" class="btn btn-blue d-block d-md-none d-lg-none" style="width: 100%">
            <span class="  w-100"><span style="float:right">ناحیه کاربری</span><span id="icon-panel" class="positive" style="float:left">+</span></span>
        </button>
    </div>
    <div id="mobile_menu_nav_ul">
        <div class="user_avatar">
            <!--<img class="avatar" src="{{ $src }}">-->
            <div class="first_name_user">{{ $user->first_name.' '.$user->last_name }}</div>
            <div>{{$user->cellphone}}</div>
            <div>{{$user->Role->display_name}}</div>
        </div>
        <ul class="profile_sidebar_items">
             <li>
                <a href="{{ route('home.orders.users_profile.index') }}"
                   class="{{ request()->is('profile/orders') ? 'active' : '' }}">
                    <i class="w-icon-orders ml-1"></i>
                 سفارش های من
                </a>
            </li>
                <li>
                <a href="{{ route('home.profile.coupon.index') }}"
                   class="{{ request()->is('profile/coupons') ? 'active' : '' }}">
                    <i class="fas fa-percent ml-1"></i>
                   کد تخفیف
                </a>
            </li>
             <li>
                <a href="{{ route('home.addresses.index') }}"
                   class="{{ request()->is('profile/addresses') ? 'active' : '' }}">
                    <i class="w-icon-products ml-1"></i>
                    آدرس ها
                </a>
            </li>
              <li>
                <a href="{{ route('home.wishlist.users_profile.index') }}"
                   class="{{ request()->is('profile/wishlist') ? 'active' : '' }}">
                    <i class="w-icon-heart ml-1"></i>
                    لیست علاقه مندی ها
                </a>
            </li>
               <li>
                <a href="{{ route('home.profile.informMe.index') }}"
                   class="{{ request()->is('profile/informMe') ? 'active' : '' }}">
                    <i class="fas fa-bell ml-1"></i>
                    در انتظار موجودی
                </a>
            </li>
             <li>
                <a href="{{ route('home.profile.wallet.index') }}"
                   class="{{ request()->is('profile/wallet') ? 'active' : '' }}">
                    <i class="w-icon-wallet2 ml-1"></i>
                   کیف پول
                </a>
            </li>
             
            <li>
                <a href="{{ route('home.comments.users_profile.index') }}"
                   class="{{ request()->is('profile/comments') ? 'active' : ( request()->is('comments/create') ? 'active' : '') }}">
                    <i class="w-icon-comment ml-1"></i>
                    دیدگاه ها
                </a>
            </li>
            
            <li>
                <a href="{{ route('home.ticket.index') }}"
                   class="{{ request()->is('profile/ticketIndex') ? 'active' : '' }}">
                    <i class="w-icon-cog2 ml-1"></i>
                    درخواست پشتیبانی
                </a>
            </li>
          
            <li>
                <a href="{{ route('home.profile.role_request.index') }}"
                   class="{{ request()->is('profile/role-request') ? 'active' : '' }}">
                    <i class="fas fa-users ml-1"></i>
                   درخواست حساب کاربری حقوقی
                </a>
            </li>
              <li>
                
                <a href="{{ route('home.users_profile.index') }}"
                   class="{{ request()->is('profile') ? 'active' : '' }}">
                    <i class="w-icon-user ml-1"></i>
                    اطلاعات حساب کاربری
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}">
                    <i class="fa fa-sign-out-alt ml-1"></i>
                    خروج
                </a>
            </li>
        </ul>
    </div>

</div>
