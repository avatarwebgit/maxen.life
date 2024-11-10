<div class="mobile-menu-wrapper">
    <div class="mobile-menu-overlay"></div>
    <!-- End of .mobile-menu-overlay -->

    <a href="#" class="mobile-menu-close"><i class="close-icon"></i></a>
    <!-- End of .mobile-menu-close -->

    <div class="mobile-menu-container scrollable">


        <!-- End of Search Form -->
        <div class="tab">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a style="    padding: 0;
    padding-bottom: 10px;
    margin-top: 10px;" href="#categories" class="nav-link active">
                    دسته بندی محصولات
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#main-menu" class="nav-link">منوی اصلی </a>
                </li>
            </ul>
        </div>
        <div style="margin-top: 31px" class="tab-content">
            <div class="tab-pane active" id="categories">
                <ul class="mobile-menu">
                    <?php
                    $categories = \App\Models\Category::where('parent_id', 0)->where('is_active',1)->orderby('priority','asc')->get();
                    $user = auth()->user();
                    ?>
                    @foreach($categories as $cat)
                        @if($cat->id!=30)
                                <?php
                                $children_categories = \App\Models\Category::where('parent_id', $cat->id)
                                    ->where('is_active',1)
                                    ->orderby('priority','asc')->get();
                                ?>
                            @if(count($children_categories)>0)
                                <li>
                                    <a href="{{ route('home.product_categories',['category'=>$cat->alias]) }}">
                                        
                                        <i class="{{ $cat->icon }}"></i>
                                        {{ $cat->name }}
                                    </a>
                                    <ul>
                                        @foreach($children_categories as $item)
                                            <li>
                                                <a href="{{ route('home.product_categories',['category'=>$item->alias]) }}">{{ $item->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('home.product_categories',['category'=>$cat->alias]) }}">
                                        <i class="{{ $cat->icon }}"></i>{{ $cat->name }}
                                    </a>
                                </li>
                            @endif
                        @endif
                    @endforeach
                    @foreach($categories as $cat)
                        @if($cat->id==30 and isset($user) and $user->getRawOriginal('role')==3)
                                <?php
                                $children_categories = \App\Models\Category::where('parent_id', $cat->id)
                                    ->where('is_active',1)
                                    ->orderby('priority','asc')->get();
                                ?>
                            @if(count($children_categories)>0)
                                <li>
                                    <a href="{{ route('home.product_categories',['category'=>$cat->alias]) }}">
                                        <i class="{{ $cat->icon }}"></i>{{ $cat->name }}
                                    </a>
                                    <ul>
                                        @foreach($children_categories as $item)
                                            <li>
                                                <a href="{{ route('home.product_categories',['category'=>$item->alias]) }}">{{ $item->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('home.product_categories',['category'=>$cat->alias]) }}">
                                        <i class="{{ $cat->icon }}"></i>{{ $cat->name }}
                                    </a>
                                </li>
                            @endif
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="tab-pane" id="main-menu">
                <ul class="mobile-menu">
                    <li class="{{ request()->is('/') ? 'active' : '' }}">
                        <a href="{{ route('home.index') }}">صفحه اصلی </a>
                    </li>
                  
                    <li class="{{ request()->is('products/new') ? 'active' : '' }}">
                        <a href="{{ route('home.products.new') }}">محصولات جدید</a>
                    </li>
                    <li class="{{ request()->is('products/special') ? 'active' : '' }}">
                        <a href="{{ route('home.products.special') }}">فروش ویژه </a>
                    </li>
                    <!--<li class="{{ request()->is('products/discount') ? 'active' : '' }}">-->
                    <!--    <a href="{{ route('home.products.discount') }}">تخفیف ویژه </a>-->
                    <!--</li>-->
                    <!--  <li class="{{ request()->is('/brands') ? 'active' : '' }}">-->
                    <!--    <a href="{{ route('home.brands') }}">برندها </a>-->
                    <!--</li>-->
                    <li>
                        <a href="/contact">تماس با پروفیل سازه</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
