<?php
$setting = \App\Models\Setting::first();
?>


<div class="site-header">
    <div style="direction:{{app()->getLocale() == 'en' ? 'rtl !important' : ''}}" class="extend-container row-md d-flex  align-items-baseline justify-content-between align-items-end">

        <div style="direction:ltr" class="menu-icon d-flex align-items-center">

            <div class="text-menu p-relative font-heading text-transform-upper">
                <!--<div class="p-absolute text-button">منو</div>-->
                <!--<div class="p-absolute text-open">گشودن</div>-->
                <div class="p-absolute text-close">بستن</div>
            </div>
                                            <a onclick="changeLang('{{app()->getLocale() == 'fa' ? route('fa') : route('en')}}',event)" class="user-no-selection change-lang-btn-mobile d-block d-md-none">

                        <span class="dsn-title-menu {{app()->getLocale() == 'fa' ? 'text-dark'  : 'text-grey'}}">  {{ app()->getLocale() == 'fa' ? 'En' : 'Fa' }} </span>
                        <span>/</span>
                        <span class="dsn-title-menu {{app()->getLocale() == 'fa' ? 'text-grey'  : 'text-dark'}}">{{ app()->getLocale() == 'fa' ? 'Fa' : 'En' }}</span>
                        <span class="dsn-bg-arrow"></span>
                    </a>
            <div class="icon-m" data-dsn="parallax">
<div class="change-lang-btn">
                                    <div class="divider"></div>
                                    <div class="divider"></div>
                                </div>
            </div>
        </div>

        <nav class="accent-menu main-navigation p-absolute w-100 d-flex align-items-baseline">
            <div class="menu-cover-title"></div>

            <ul style="direction:{{app()->getLocale()=='en' ? 'ltr !important': ''}}" class="dir-rtl extend-container p-relative d-flex flex-column justify-content-center h-100">

        @if(app()->getLocale() == 'fa')
                                                                                            <li  style="display: inline-flex !important;
    vertical-align: 25px;" class="dsn-active dsn-drop-down menu-sidebar">
<div class="change-lang-btn">
                                    <div class="divider"></div>
                                    <div class="divider"></div>
                                </div>

                    <a href="{{ app()->getLocale() == 'fa' ? route('en') : route('fa') }}" class="user-no-selection">

                        <span class="dsn-title-menu">  {{ app()->getLocale() == 'fa' ? 'En' : 'Fa' }} </span>
                        <span>/</span>
                        <span>{{ app()->getLocale() == 'fa' ? 'Fa' : 'En' }}</span>
                        <span class="dsn-bg-arrow"></span>
                    </a>


                </li>
                     <li class="dsn-active dsn-drop-down">

                    <a  class="user-no-selection search-toggler">
                        <!--                    <form method="get" action="{{ route('home.product.search') }}" class="search">-->

                        <!--<input placeholder="{{__('Search')}}" type="text" name="search">-->
                        <!--</form>-->

                                            <img width="33" src="{{asset('home/img/search.svg')}}">

                    </a>


                </li>



        @endif

                   @php
                            $menus = \App\Models\Menu::where('parent_id',null)->orderBy('sort')->get();

                          @endphp


                                  @foreach($menus as $menu)
                                  @if($menu->type == 'blog')
                <li class="dsn-active {{$menu->is_show_header ==2 ? '' : ($menu->is_show_header == 1 ? 'd-block': 'd-md-none') }}  dsn-drop-down">
                                                                                     <?php
                            $categories_article = \App\Models\ArticleCategoriy::all();
                            ?>
                    <a href="{{route('home.articles')}}"  class="user-no-selection">
                        <span class="dsn-title-menu">  {{app()->getLocale() == 'fa' ? $menu->name : $menu->name_en}} </span>
                        <span class="dsn-bg-arrow"></span>
                    </a>
                    @if(count($categories_article) > 0)
                    <ul>
                        @foreach($categories_article as $category)

                        <li>
                            <a href="{{ route('home.articles.category',['category'=>$category->alias]) }}"><span class="dsn-title-menu">{{app()->getLocale() == 'en' ? $category->title_en : $category->title }}</span></a>
                        </li>
                        @endforeach

                    </ul>
                    @endif

                </li>
                                  @endif

             @if($menu->type == 'product')

                <li class="dsn-active {{$menu->is_show_header ==2 ? '' : ($menu->is_show_header == 1 ? 'd-block': 'd-md-none') }} dsn-drop-down">
                    <?php
                       $categories = \App\Models\Category::where('parent_id', 0)->where('is_active',1)->orderby('priority','asc')->get();
                    ?>
                    <a href="#"  class="user-no-selection">
                        <span class="dsn-title-menu">  {{app()->getLocale() == 'fa' ? $menu->name : $menu->name_en}} </span>
                        <span class="dsn-bg-arrow"></span>
                    </a>
                    @if(count($categories) > 0)
                    <ul>
                        @foreach($categories as $category)

                        <li>
                            <a href="{{route('home.product_categories',['category'=>$category->alias ])}}"><span class="dsn-title-menu">{{app()->getLocale() == 'en' ? $category->name_en : $category->name }}</span></a>
                        </li>
                        @endforeach

                    </ul>
                    @endif

                </li>
              @endif


                                          @if($menu->type == 'link')


                                            <li class="dsn-active {{$menu->is_show_header == 2 ? '' : ($menu->is_show_header == 1 ? 'd-block': 'd-md-none') }}  dsn-drop-down">


                    <a href="{{$menu->link}}"  class="user-no-selection">
                        <span class="dsn-title-menu">  {{app()->getLocale() == 'fa' ? $menu->name : $menu->name_en}} </span>
                        <span class="dsn-bg-arrow"></span>
                    </a>
         @if(!$menu->children->isEmpty())
                    <ul>

                             @foreach($menu->children as $menu)

                  @if($menu->type == 'link')
                        <li>
                            <a href="{{$menu->link}}"><span class="dsn-title-menu">{{app()->getLocale() == 'fa' ? $menu->name : $menu->name_en}} </span></a>
                        </li>

                        @endif

                         @if($menu->type == 'page')
                                               @php

                             $page = \App\Models\Page::where('id', $menu->page_id)->first();

                             @endphp
                        <li>
                            <a href="{{route('home.page',['page'=>$page->alias])}}"><span class="dsn-title-menu">{{app()->getLocale() == 'fa' ? $menu->name : $menu->name_en}}</span></a>
                        </li>

                        @endif

                        @endforeach

                    </ul>
                    @endif

                </li>

                                          @endif


                        @if($menu->type == 'page')
                             @php

                             $page = \App\Models\Page::where('id', $menu->page_id)->first();

                             @endphp

                                 <li class="dsn-active {{$menu->is_show_header == 2 ? '' : ($menu->is_show_header == 1 ? 'd-block': 'd-md-none') }} dsn-drop-down">
                    <a href="{{route('home.page',['page'=>$page->alias])}}" class="user-no-selection">
                        <span class="dsn-title-menu">   {{app()->getLocale() == 'fa' ? $menu->name : $menu->name_en}} </span>
                        <span class="dsn-bg-arrow"></span>
                    </a>
                                     @if(!$menu->children->isEmpty())
                                         <ul>

                                             @foreach($menu->children as $menu)

                                                 @if($menu->type == 'link')
                                                     <li>
                                                         <a href="{{$menu->link}}"><span class="dsn-title-menu">{{app()->getLocale() == 'fa' ? $menu->name : $menu->name_en}} </span></a>
                                                     </li>

                                                 @endif

                                                 @if($menu->type == 'page')
                                                     @php

                                                         $page = \App\Models\Page::where('id', $menu->page_id)->first();

                                                     @endphp
                                                     <li>
                                                         <a href="{{route('home.page',['page'=>$page->alias])}}"><span class="dsn-title-menu">{{app()->getLocale() == 'fa' ? $menu->name : $menu->name_en}}</span></a>
                                                     </li>

                                                 @endif

                                             @endforeach

                                         </ul>
                                     @endif

                </li>


                             @endif


                         @endforeach

                        @if(app()->getLocale() == 'en')
                     <li class="dsn-active dsn-drop-down">

                    <a  class="user-no-selection search-toggler">
                        <!--                    <form method="get" action="{{ route('home.product.search') }}" class="search">-->

                        <!--<input placeholder="{{__('Search')}}" type="text" name="search">-->
                        <!--</form>-->
                        <img width="33" src="{{asset('home/img/search.svg')}}">
                    </a>


                </li>

                                                                    <li style="    display: inline-flex !important;
        vertical-align: 11px;
    flex-direction: row-reverse;margin-right:0" class="dsn-active dsn-drop-down menu-sidebar">
                                <div class="change-lang-btn">
                                    <div class="divider"></div>
                                    <div class="divider"></div>
                                </div>
                    <a href="{{ app()->getLocale() == 'fa' ? route('en') : route('fa') }}" class="user-no-selection">

                        <span class="dsn-title-menu">  {{ app()->getLocale() == 'fa' ? 'En' : 'Fa' }} </span>
                        <span>/</span>
                        <span>{{ app()->getLocale() == 'fa' ? 'Fa' : 'En' }}</span>
                        <span class="dsn-bg-arrow"></span>
                    </a>


                </li>

        @endif



            </ul>



            <!--                    <div class="nav-border-bottom"></div>-->
        </nav>

        <div class="inner-header p-relative">
            <div  class="main-logo">

                    <img class="{{!request()->is('/') ?  '' : 'img-main-logo'}}" src="{{ imageExist(env('LOGO_UPLOAD_PATH'),$setting->image) }}">



                <p class="font-helvetica title-scroll-other-page d-md-block">
                    Lifestyle Solution
                </p>

                                    <a  class="user-no-selection d-block d-md-none search-toggler-mobile">
                        <!--                    <form method="get" action="{{ route('home.product.search') }}" class="search">-->

                        <!--<input placeholder="{{__('Search')}}" type="text" name="search">-->
                        <!--</form>-->

                                            <img width="33" src="{{asset('home/img/search.svg')}}">

                    </a>
                <a href="/" data-dsn="parallax">
                    <!--                            <img class="dark-logo" src="assets/img/logo-dark.png" alt="" />-->
                    <!--                            <img class="light-logo" src="assets/img/logo.png" alt="" />-->
                </a>
            </div>
        </div>
    </div>
</div>
