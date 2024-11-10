<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion pr-0" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a target="_blank" class="sidebar-brand d-flex align-items-center justify-content-center" href="https://www.avatarweb.net/">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('admin/images/avatarWhite.png') }}">
        </div>
        <div class="sidebar-brand-text mx-3"></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a target="_blank" class="nav-link" href="{{ route('home.index') }}">
            <i class="fas fa-sign-out-alt"></i>
            <span> برو به سایت </span></a>
    </li>

@if(
request()->is('admin-panel/management/dashboard*')
)
    <?php
    $text_white = 'text-white';
    $active = 'active';
    ?>
@else
    <?php
    $text_white = '';
    $active = '';
    ?>
@endif
<!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ $active }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt {{ $text_white }}"></i>
            <span class="{{ $text_white }}"> داشبورد </span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

@if(
request()->is('admin-panel/management/user*')
)
    <?php
    $text_white = 'text-white';
    ?>
@else
    <?php
    $text_white = '';
    ?>
@endif
<!-- Users -->
    <!--<li class="nav-item {{ request()->is('admin-panel/management/user/index') ? 'active' : '' }}">-->
    <!--    <a class="nav-link" href="{{ route('admin.user.index') }}">-->
    <!--        <i class="fas fa-user {{ $text_white }}"></i>-->
    <!--        <span class="{{ $text_white }} position-relative"> کاربران-->
                <?php
                $request_count=\App\Models\User::where('role_request_status', 1)->count();
                ?>
    <!--            @if($request_count!=0)-->
    <!--                <span style="background-color: red;width: 20px;height: 20px;border-radius: 100%;text-align: center;vertical-align: center;color: white;position: absolute;top: -10px">{{ $request_count }}</span>-->
    <!--            @endif-->
    <!--        </span>-->
    <!--    </a>-->
    <!--</li>-->

@if(
request()->is('admin-panel/management/banners*') or
request()->is('admin-panel/management/setting/animation_banner/edit')
)
    <?php
    $collapse = '';
    $show = 'show';
    $text_white = 'text-white';
    ?>
@else
    <?php
    $collapse = 'collapsed';
    $show = '';
    $text_white = '';
    ?>
@endif
<!-- Divider -->
    <hr class="sidebar-divider">

<!-- Heading -->
    <div class="sidebar-heading">
        صفحه اصلی
    </div>

    <li class="nav-item">
        <a class="nav-link {{ $collapse }}" href="#" data-toggle="collapse" data-target="#collapseMainPageSetting" aria-expanded="true"
           aria-controls="collapsePages">
            <i class="fas fa-cogs {{ $text_white }}"></i>
            <span class="{{ $text_white }}"> تنظیمات صفحه اصلی </span>
        </a>
        <div id="collapseMainPageSetting" class="collapse {{ $show }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item {{ request()->is('admin-panel/management/menus*') ? 'bg-active' : '' }}" href="{{ route('admin.menus.index') }}">منو سایت </a>
                <a class="collapse-item {{ request()->is('admin-panel/management/sliders*') ? 'bg-active' : '' }}" href="{{ route('admin.sliders.index') }}">اسلایدر صفحه اصلی</a>
                <a class="collapse-item {{ request()->is('admin-panel/management/banners*') ? 'bg-active' : '' }}" href="{{ route('admin.banners.index') }}">بنرها</a>
                <a class="collapse-item {{ request()->is('admin-panel/management/banners*') ? 'bg-active' : '' }}" href="{{ route('admin.news.index') }}">آلبوم</a>
                
                
                
                    
<!--<a class="collapse-item {{ request()->is('admin-panel/management/banners*') ? 'bg-active' : '' }}" href="{{ route('admin.setting.title',['section'=>'contact']) }}">     بخش تماس ما</a>-->
                                <a class="collapse-item {{ request()->is('admin-panel/management/banners*') ? 'bg-active' : '' }}" href="{{ route('admin.setting.title',['section'=>'product']) }}">     بخش محصولات </a>
                    <a class="collapse-item {{ request()->is('admin-panel/management/banners*') ? 'bg-active' : '' }}" href="{{ route('admin.setting.title',['section'=>'news']) }}">      بخش بنرها </a>
                                     <a class="collapse-item {{ request()->is('admin-panel/management/banners*') ? 'bg-active' : '' }}" href="{{ route('admin.setting.title',['section'=>'cookie']) }}">     متن کوکی </a>
                                                                                    <a class="collapse-item {{ request()->is('admin-panel/management/banners*') ? 'bg-active' : '' }}" href="{{ route('admin.setting.title',['section'=>'about']) }}">     متن های درباره ما صفحه اصلی   </a>
                                                                          <a class="collapse-item {{ request()->is('admin-panel/management/banners*') ? 'bg-active' : '' }}" href="{{ route('admin.setting.title',['section'=>'home']) }}">     متن پایین صفحه اصلی </a>

                                                 <a class="collapse-item {{ request()->is('admin-panel/management/banners*') ? 'bg-active' : '' }}" href="{{ route('admin.setting.title',['section'=>'footer']) }}">     بخش فوتر </a>
                                                 
                        

            </div>
        </div>
    </li>

    <!-- Divider -->

@if(
request()->is('admin-panel/management/update/products/single*') or
request()->is('admin-panel/management/update/products/multi*')
)
    <?php
    $collapse = '';
    $show = 'show';
    $text_white = 'text-white';
    ?>
@else
    <?php
    $collapse = 'collapsed';
    $show = '';
    $text_white = '';
    ?>
@endif
<!-- Heading -->
{{--    <div class="sidebar-heading">--}}
{{--        دسترسی سریع--}}
{{--    </div>--}}

{{--    <li class="nav-item">--}}
{{--        <a class="nav-link {{ $collapse }}" href="#" data-toggle="collapse" data-target="#collapseUpdatePrices" aria-expanded="true"--}}
{{--           aria-controls="collapsePages">--}}
{{--            <i class="fas fa-cogs {{ $text_white }}"></i>--}}
{{--            <span class="{{ $text_white }}"> بروز رسانی قیمت ها </span>--}}
{{--        </a>--}}
{{--        <div id="collapseUpdatePrices" class="collapse {{ $show }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">--}}
{{--            <div class="bg-white py-2 collapse-inner rounded">--}}
{{--                <a class="collapse-item {{ request()->is('admin-panel/management/update/products/single*') ? 'bg-active' : '' }}" href="{{ route('admin.products.single.update') }}">محصولات تکی</a>--}}
{{--                <a class="collapse-item {{ request()->is('admin-panel/management/update/products/multi*') ? 'bg-active' : '' }}" href="{{ route('admin.products.multi.update') }}">محصولات دارای رنگ بندی</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </li>--}}

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        فروشگاه
    </div>

    @if(
        request()->is('admin-panel/management/products*') or
        request()->is('admin-panel/management/categories*') or
        request()->is('admin-panel/management/brands*') or
        request()->is('admin-panel/management/attributes*') or
        request()->is('admin-panel/management/functionalType*') or
        request()->is('admin-panel/management/labels*') or
        request()->is('admin-panel/management/comments*')
    )
        <?php
        $collapse = '';
        $show = 'show';
        $text_white = 'text-white';
        ?>
    @else
        <?php
        $collapse = 'collapsed';
        $show = '';
        $text_white = '';
        ?>
    @endif

<!-- Nav Item - Brand -->
    <li class="nav-item">
        <a class="nav-link {{ $collapse }}" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="true"
           aria-controls="collapsePages">
            <i class="fas fa-fw fa-cart-plus {{ $text_white }}"></i>
            <span class="{{ $text_white }}"> محصولات </span>
        </a>
        <div id="collapseProducts" class="collapse {{ $show }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->is('admin-panel/management/products*') ? 'bg-active' : '' }}" href="{{ route('admin.products.index') }}">محصولات</a>
                <a class="collapse-item {{ request()->is('admin-panel/management/categories*') ? 'bg-active' : '' }}" href="{{ route('admin.categories.index') }}">دسته بندی ها</a>
                <!--<a class="collapse-item {{ request()->is('admin-panel/management/brands*') ? 'bg-active' : '' }}" href="{{ route('admin.brands.index') }}">برند ها</a>-->
                <a class="collapse-item {{ request()->is('admin-panel/management/attributes*') ? 'bg-active' : '' }}" href="{{ route('admin.attributes.index') }}">مشخصات فنی</a>
                <a class="collapse-item {{ request()->is('admin-panel/management/functionalType*') ? 'bg-active' : '' }}" href="{{ route('admin.functionalType.index') }}">براساس عملکرد</a>
                <a class="collapse-item {{ request()->is('admin-panel/management/labels*') ? 'bg-active' : '' }}" href="{{ route('admin.labels.index') }}">برچسب</a>
                <!--<a class="collapse-item {{ request()->is('admin-panel/management/comments*') ? 'bg-active' : '' }}" href="{{ route('admin.comments.index') }}">نظرات</a>-->
                {{--                <a class="collapse-item" href="{{ route('admin.tags.index') }}">تگ ها</a>--}}
            </div>
        </div>
    </li>


    @if(
        request()->is('admin-panel/management/deliveryMethod*')
    )
        <?php
        $collapse = '';
        $show = 'show';
        $text_white = 'text-white';
        ?>
    @else
        <?php
        $collapse = 'collapsed';
        $show = '';
        $text_white = '';
        ?>
    @endif

<!--    <li class="nav-item">-->
<!--        <a class="nav-link {{ $collapse }}" href="#" data-toggle="collapse" data-target="#collapseDeliveryMethods" aria-expanded="true"-->
<!--           aria-controls="collapsePages">-->
<!--            <i class="fas fa-shipping-fast {{ $text_white }}"></i>-->
<!--            <span class="{{ $text_white }}"> روش های ارسال </span>-->
<!--        </a>-->
<!--        <div id="collapseDeliveryMethods" class="collapse {{ $show }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">-->
<!--            <div class="bg-white py-2 collapse-inner rounded">-->
<!--{{--                <a class="collapse-item {{ request()->is('admin-panel/management/deliveryMethod/post*') ? 'bg-active' : '' }}" href="{{ route('admin.delivery_method.edit',['method'=>'post']) }}">پست پیشتاز</a>--}}-->
<!--{{--                <a class="collapse-item {{ request()->is('admin-panel/management/deliveryMethod/peyk*') ? 'bg-active' : '' }}" href="{{ route('admin.delivery_method.edit',['method'=>'peyk']) }}">پیک فروشگاه</a>--}}-->
<!--                <a class="collapse-item {{ request()->is('admin-panel/management/deliveryMethod/truck*') ? 'bg-active' : '' }}" href="{{ route('admin.delivery_method.edit',['method'=>'truck']) }}">باربری</a>-->
<!--                <a class="collapse-item {{ request()->is('admin-panel/management/deliveryMethod/bus*') ? 'bg-active' : '' }}" href="{{ route('admin.delivery_method.edit',['method'=>'bus']) }}">تعاونی اتوبوسرانی</a>-->
<!--                <a class="collapse-item {{ request()->is('admin-panel/management/deliveryMethod/َAlopeyk*') ? 'bg-active' : '' }}" href="{{ route('admin.delivery_method.edit',['method'=>'َAlopeyk']) }}">الوپیک</a>-->
                <!--<a class="collapse-item {{ request()->is('admin-panel/management/deliveryMethod/tipox*') ? 'bg-active' : '' }}" href="#">تیپاکس</a>-->
<!--                <a class="collapse-item {{ request()->is('admin-panel/management/deliveryMethod') ? 'bg-active' : '' }}" href="{{ route('admin.delivery_method.index') }}">تنظیمات</a>-->
<!--            </div>-->
<!--        </div>-->
<!--    </li>-->


    @if(
        request()->is('admin-panel/management/setting*') or
        request()->is('admin-panel/management/paymentMethods*') or
        request()->is('admin-panel/management/commentIndex*')
    )
        <?php
        $collapse = '';
        $show = 'show';
        $text_white = 'text-white';
        ?>
    @else
        <?php
        $collapse = 'collapsed';
        $show = '';
        $text_white = '';
        ?>
    @endif

    <li class="nav-item">
        <a class="nav-link {{ $collapse }}" href="#" data-toggle="collapse" data-target="#collapseSetting" aria-expanded="true"
           aria-controls="collapsePages">
            <i class="fas fa-fw fa-cog {{ $text_white }}"></i>
            <span class="{{ $text_white }}"> تنظیمات </span>
        </a>
        <div id="collapseSetting" class="collapse {{ $show }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->is('admin-panel/management/setting*') ? 'bg-active' : '' }}" href="{{ route('admin.setting.edit',['setting'=>1]) }}">اطلاعات فروشگاه</a>
                <!--<a class="collapse-item {{ request()->is('admin-panel/management/paymentMethods*') ? 'bg-active' : '' }}" href="{{ route('admin.paymentMethods') }}">درگاه های پرداخت</a>-->
                {{--                <a class="collapse-item {{ request()->is('admin-panel/management/commentIndex*') ? 'bg-active' : '' }}" href="{{ route('admin.Comment_index') }}">نظرات صفحه اصلی</a>--}}
                <!--<a class="collapse-item" href="{{ route('admin.provinces.index') }}">لیست استان ها و شهر ها</a>-->
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">

@if(
request()->is('admin-panel/management/orders*') or
request()->is('admin-panel/management/transactions*') or
request()->is('admin-panel/management/gift*') or
request()->is('admin-panel/management/limit*') or
request()->is('admin-panel/management/coupons*')
)
    <?php
    $collapse = '';
    $show = 'show';
    $text_white = 'text-white';
    ?>
@else
    <?php
    $collapse = 'collapsed';
    $show = '';
    $text_white = '';
    ?>
@endif


    <!--<li class="nav-item">-->
    <!--    <a class="nav-link {{ $collapse }}" href="#" data-toggle="collapse" data-target="#collapseOrders" aria-expanded="true"-->
    <!--       aria-controls="collapsePages">-->
    <!--        <i class="fas fa-fw fa-folder {{ $text_white }}"></i>-->
    <!--        <span class="{{ $text_white }}"> سفارشات </span>-->
    <!--    </a>-->
    <!--    <div id="collapseOrders" class="collapse {{ $show }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">-->
    <!--        <div class="bg-white py-2 collapse-inner rounded">-->
    <!--            <a class="collapse-item {{ request()->is('admin-panel/management/orders*') ? 'bg-active' : '' }}" href="{{ route('admin.orders.index') }}">سفارشات</a>-->
    <!--            <a class="collapse-item {{ request()->is('admin-panel/management/transactions*') ? 'bg-active' : '' }}" href="{{ route('admin.transactions.index') }}">تراکنش ها</a>-->
    <!--            <a class="collapse-item {{ request()->is('admin-panel/management/coupons*') ? 'bg-active' : '' }}" href="{{ route('admin.coupons.index') }}">کوپن ها</a>-->
    <!--            <a class="collapse-item {{ request()->is('admin-panel/management/gift*') ? 'bg-active' : '' }}" href="{{ route('admin.gift.index') }}">هدیه تراکنش</a>-->
    <!--            <a class="collapse-item {{ request()->is('admin-panel/management/limit*') ? 'bg-active' : '' }}" href="{{ route('admin.orders.limit') }}">محدودیت خرید</a>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</li>-->

    <!-- Divider -->

@if(
request()->is('admin-panel/management/articles*')
)
    <?php
    $text_white = 'text-white';
    $active = 'active';
    ?>
@else
    <?php
    $text_white = '';
    $active = '';
    ?>
@endif
<!-- Nav Item - Brand -->
    <li class="nav-item {{ $active }}">
        <a class="nav-link" href="{{ route('admin.articles.index') }}">
            <i class="fas fa-store {{ $text_white }}"></i>
            <span class="{{ $text_white }}"> مقالات </span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
@if(
request()->is('admin-panel/management/pages*')
)
    <?php
    $text_white = 'text-white';
    $active = 'active';
    ?>
@else
    <?php
    $text_white = '';
    $active = '';
    ?>
@endif
<!-- Nav Item - Brand -->
    <!-- Nav Item - Brand -->
    <li class="nav-item {{ $active }}">
        <a class="nav-link text-right {{ $active }}" href="{{ route('admin.pages.index') }}">
            <i class="fas fa-envelope {{ $text_white }}"></i>
            <span class="{{ $text_white }}"> صفحات </span></a>
    </li>



@if(
request()->is('admin-panel/management/contact*')
)
    <?php
    $text_white = 'text-white';
    $active = 'active';
    ?>
@else
    <?php
    $text_white = '';
    $active = '';
    ?>
@endif


    <li class="nav-item {{ $active }}">
        <a class="nav-link" href="{{ route('admin.contact.edit') }}">
            <i class="fas fa-store {{ $text_white }}"></i>
            <span class="{{ $text_white }}"> تماس با ما </span>
        </a>
    </li>


    <!-- Divider -->
    
@if(
request()->is('admin-panel/management/ticket*')
)
    <?php
    $text_white = 'text-white';
    $active = 'active';
    ?>
@else
    <?php
    $text_white = '';
    $active = '';
    ?>
@endif
<!-- Divider -->
    <!--<hr class="sidebar-divider d-none d-md-block">-->
    <!-- Nav Item - Brand -->
    <!--<li class="nav-item {{ $active }}">-->
    <!--    <a class="nav-link text-right {{ $active }}" href="{{ route('admin.ticket.index') }}">-->
    <!--        <i class="fas fa-envelope {{ $text_white }}"></i>-->
    <!--        <span class="{{ $text_white }}"> تیکت ها </span></a>-->
    <!--</li>-->

@if(
request()->is('admin-panel/management/contact*')
)
    <?php
    $text_white = 'text-white';
    $active = 'active';
    ?>
@else
    <?php
    $text_white = '';
    $active = '';
    ?>
@endif
<!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Nav Item - Brand -->
    <li class="nav-item {{ $active }}">
        <a class="nav-link text-right {{ $active }}" href="{{ route('admin.contact.index') }}">
            <i class="fas fa-envelope {{ $text_white }}"></i>
            <span class="{{ $text_white }}"> فرم های تماس با ها </span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
