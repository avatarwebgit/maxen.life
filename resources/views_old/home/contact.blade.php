@extends('home.layouts.index')

@section('title')
    تماس با پروفیل سازه
@endsection

@section('description')

@endsection

@section('keywords')

@endsection

@section('style')
    <style>
        .w-icon-mobile{
            font-size: 50px !important;
        }
        .border-error{
            border:2px solid red;
        }
        .card-header i{
            left:10px;
            position: absolute;
            transition: all .3s ease ;

        }
        .collapse i{
            transform: rotate(-90deg);
        }
        .title{
            font-size:1.8rem;
        }

    </style>
@endsection

@section('script')
    <script>
        function arrowopen(tag){
            $(tag).find('i').toggleClass('active-arrow')
        }
        </script>
 @endsection

            @section('content')
            <!-- Start of Main -->
            <main class="main">
                <!-- Start of PageContent -->
                <div class="page-content contact-us">
                    <div class="container">
                        <div class="row my-3">
                            @if($page->banner_is_active==1)
                            <div class="col-12">
                            <div class="shop-default-banner banner d-flex align-items-center mb-5 br-xs"
                                 style="">
                                <img style="width: 100%" src="{{imageExist(env('BANNER_PAGES_UPLOAD_PATH'),$page->image)}}">
                            </div>
                            </div>
                            @endif
                            <div class="col-12">
                            <h2 class="titlepage title">
                                {!! $page->title !!}
                            </h2>
                            </div>
                            {{--
                    <div class="col-12 justify-content-center">
                        <hr>
                    </div>
                    <div class="col-12">
                        {!! $page->description !!}
                    </div>
                    --}}
                        </div>
                        <!-- End of Contact Title Section -->

                        <section class="contact-information-section mb-10">
                            <div class=" swiper-container swiper-theme " data-swiper-options="{
                            'spaceBetween': 20,
                            'slidesPerView': 1,
                            'breakpoints': {
                                '480': {
                                    'slidesPerView': 2
                                },
                                '768': {
                                    'slidesPerView': 3
                                },
                                '992': {
                                    'slidesPerView': 4
                                }
                            }
                        }">
                                <div class="swiper-wrapper row cols-xl-4 cols-md-3 cols-sm-2 cols-1">
                                    <div class="swiper-slide icon-box text-center icon-box-primary">
                                    <span class="icon-box-icon icon-headphone">
                                        <i class="w-icon-headphone"></i>
                                    </span>
                                        <div class="icon-box-content">
                                            <h4 class="icon-box-title">{{$setting->contact_1}} </h4>
                                            <p>@if($setting->tel!=null)
                                            <a href="tel:{{ $setting->tel }}" class="widget-about-call">{{ $setting->tel }}</a>
                                                @endif</p>
                                            <p>@if($setting->tel2!=null)
                                            <a href="tel:{{ $setting->tel2 }}" class="widget-about-call">{{ $setting->tel2 }}</a>
                                                @endif</p>

                                        </div>
                                    </div>
                                    <div class="swiper-slide icon-box text-center icon-box-primary">
                                    <span class="icon-box-icon icon-headphone">
                                        <i class="w-icon-headphone"></i>
                                    </span>
                                        <div class="icon-box-content">
                                            <h4 class="icon-box-title">{{$setting->contact_2}} </h4>
                                            <p>@if($setting->tel3!=null)
                                            <a href="tel:{{ $setting->tel3 }}" class="widget-about-call">{{ $setting->tel3 }}</a>
                                                @endif</p>
                                            @if($setting->tel4!=null)
                                            <p><a href="tel:{{ $setting->tel4 }}" class="widget-about-call">{{ $setting->tel4 }}</a>
                                            @endif</p>
                                        </div>
                                    </div>
                                    <div class="swiper-slide icon-box text-center icon-box-primary">
                                    <span class="icon-box-icon icon-email">
                                        <i class="w-icon-envelop-closed"></i>
                                    </span>
                                        <div class="icon-box-content">
                                            <h4 class="icon-box-title">{{$setting->contact_3}}  </h4>
                                            <a href="mailto:info@profilesaze.com">{{ $setting->email }}</a>
                                        </div>
                                    </div>
                                    <div class="swiper-slide icon-box text-center icon-box-primary">
                                    <span class="icon-box-icon icon-map-marker">
                                        <i class="w-icon-map-marker"></i>
                                    </span>
                                        <div class="icon-box-content">
                                            <h4 class="icon-box-title">{{$setting->contact_4}} </h4>
                                            <p>{{ $setting->address }}</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="swiper-pagination"></div>
                                <button class="swiper-button-next"></button>
                                <button class="swiper-button-prev"></button>
                            </div>
                        </section>
                        <!-- End of Contact Information section -->

                        <hr class="divider mb-10 pb-1">

                            <section class="contact-section">
                                <div class="row gutter-lg pb-3">
                                    <div class="col-lg-6 mb-8">
                                        <h4 class="title mb-3">پاسخ به پرسش های متداول</h4>
                                        <div class="accordion accordion-bg accordion-gutter-md accordion-border">
                                            <div class="card">
                                                <div  class="card-header">
                                                    <a  href="#collapse1" class="">


                                                        آیا در تمامی ساعات شبانه روز، امکان ثبت سفارش وجود دارد؟
                                                        <i class="fas fas fa-angle-left"></i>
                                                    </a>
                                                </div>
                                                <div  id="collapse1" class="card-body collapsed">
                                                    <p class="mb-0">
                                                        بله؛ شما می توانید در هر ساعتی از شبانه روز، سفارش خود را ثبت کنید.
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div  class="card-header">
                                                    <a href="#collapse2" class="expand">خدمات پشتیبانی در چه ساعاتی انجام می شود؟
                                                        <i class="fas fas fa-angle-left"></i>
                                                    </a>
                                                </div>
                                                <div id="collapse2" class="card-body collapsed">
                                                    <p class="mb-0">

                                                        کارشناسان فروش پروفیل سازه، شنبه تا چهارشنبه از ساعت 10 تا 18 و پنجشنبه از ساعت 10 تا 13 پاسخگوی شما عزیزان خواهند بود. همچنین شما می توانید در ناحیه کاربری خود با ثبت تیکت، با ما در ارتباط باشید.
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div  class="card-header">
                                                    <a href="#collapse3" class="expand">آیا امکان خرید حضوری فراهم است؟
                                                        <i class="fas fas fa-angle-left"></i>
                                                    </a>
                                                </div>
                                                <div id="collapse3" class="card-body collapsed">
                                                    <p class="mb-0">
                                                        با توجه به اهداف فروش اینترنتی از قبیل سرعت و صرفه جویی در زمان، فروش محصولات در پروفیل سازه صرفا به صورت اینترنتی و غیرحضوری است.
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div  class="card-header">
                                                    <a href="#collapse4" class="expand">آیا امکان پرداخت در محل فراهم است؟
                                                        <i class="fas fas fa-angle-left"></i>
                                                    </a>
                                                </div>
                                                <div id="collapse4" class="card-body collapsed">
                                                    <p class="mb-0">
                                                        با توجه به ماهیت محصولات ارائه شده در پروفیل سازه که می بایست بر اساس سفارش مشتری آماده و تولید شوند، شرایط پرداخت در محل مهیا نمی باشد و جهت ثبت سفارش، کاربران گرامی می بایست کل مبلغ فاکتور را تسویه نمایند.
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header">
                                                    <a href="#collapse5" class="expand">سفارش ها با چه روشی ارسال می شوند؟
                                                        <i class="fas fas fa-angle-left"></i>
                                                    </a>
                                                </div>
                                                <div id="collapse5" class="card-body collapsed">
                                                    <p class="mb-0">
                                                        با توجه به نوع محصول و آدرس، روش های ارسال هر سفارش در مراحل خرید اعلام می شود.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-8">
                                        <h4 class="title mb-3">ارتباط با ما</h4>
                                        <form class="form contact-us-form" action="{{ route('home.contact') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                            <label for="username">نام و نام خانوادگی: </label>
                                            <input   type="text" id="username" name="name"
                                                     class="{{$errors->has('username') ? 'border-error': ''}} form-control">
                                                @error('username')
                                                <p class="input-error-validation">{{ $message }}</p>
                                            @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email">ایمیل:</label>
                                                <input  type="email" id="email" name="email"
                                                        class="form-control {{$errors->has('email') ? 'border-error': ''}}">
                                                    @error('email')
                                                    <p class="input-error-validation">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="message">متن پیام:</label>
                                                <textarea  id="message" name="message" cols="30" rows="5"
                                                           class="form-control {{$errors->has('message') ? 'border-error': ''}}"></textarea>
                                                @error('message')
                                                <p class="input-error-validation">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-blue btn-rounded btn-rounded">ارسال پیام</button>
                                        </form>
                                    </div>
                                </div>
                            </section>
                        <!-- End of Contact Section -->
                    </div>
                    {{--
                        <!-- Google Maps - Go to the bottom of the page to change settings and map location. -->
                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d810.067010019896!2d51.410419835652384!3d35.69502108395987!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x5c4cd87ca98a21d5!2zMzXCsDQxJzQyLjEiTiA1McKwMjQnNDEuNiJF!5e0!3m2!1sen!2sfr!4v1667642929920!5m2!1sen!2sfr" width="100%" height="380px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            --}}
                    <!-- End Map Section -->
                </div>
                <!-- End of PageContent -->
            </main>
        <!-- End of Main -->
@endsection
