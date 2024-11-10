<footer class="footer appear-animate" data-animation-options="{
            'name': 'fadeIn'
        }">
     {{--
    <div class="footer-newsletter bg-primary pt-6 pb-6">
        <div class="container">
            <div class="row justify-content-center align-items-center">

                <div class="col-xl-5 col-lg-6">
                    <div class="icon-box icon-box-side text-white">
                        <div class="icon-box-icon d-inline-flex">
                            <i class="w-icon-envelop3"></i>
                        </div>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title text-white text-uppercase mb-0">مشترک شدن در خبرنامه ما</h4>
                            <p class="text-white">تمام آخرین اطلاعات در مورد رویدادها، فروش ها و پیشنهادات را دریافت
                                کنید.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6 col-md-9 mt-4 mt-lg-0 ">
                    <form action="#" method="get"
                          class="input-wrapper input-wrapper-inline input-wrapper-rounded">
                        <input type="email" class="form-control mr-2 bg-white" name="email" id="email"
                               placeholder="آدرس ایمیل "/>
                        <button class="btn btn-dark btn-rounded" type="submit">اشتراک در <i
                                class="w-icon-long-arrow-left"></i></button>
                    </form>
                </div>

            </div>
        </div>
    </div>
     --}}
    <div class="container">
        <div class="footer-top">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="widget widget-about">

                        <div class="widget-body">
                            <h3 class="widget-title">{{$setting->footer_1}}</h3>
                            <P class="text-right">@if($setting->tel!=null)
                            <a style="font-size:1.4rem !important" href="tel:{{ $setting->tel }}" class="widget-about-call">{{ $setting->tel }}</a>
                            @endif</p>
                            <P class="text-right">@if($setting->tel2!=null)
                            <a style="font-size:1.4rem !important" href="tel:{{ $setting->tel2 }}" class="widget-about-call">{{ $setting->tel2 }}</a>
                            @endif</p>

                            <h3  class="widget-title mt-4">{{$setting->footer_2}}</h3>
                                <p style="font-size:1.4rem !important" class="time-work-style" >
                                 {{ $setting->workTime }}
                                </p>


							<h3  class="widget-title mt-4">{{$setting->footer_3}}</h3>
                                <a style="font-size:1.4rem !important" href="mailto:{{ $setting->email }}" class="widget-about-call">
                                    {{ $setting->email }}
                                </a>

                        </div>
                    </div>
                </div>
                @php
                    $pages=\App\Models\Page::where('id','!=',11)->orderBy('priority','asc')->get();
                @endphp
                <div class="col-lg-3  col-sm-6">
                    <div class="widget">

                         @foreach($pages as $page)
                         @if($page->id==2)
                          <p class="widget-about-desc">
                          <a href="{{ route('home.contact') }}" class="widget-title cursor-pointer">{{ $page->title }}</a>
                       	 </p>

                   @elseif($page->id==7)

                              <p class="widget-about-desc">
                                    <a href="{{ route('home.articles') }}" class="widget-title cursor-pointer">{{ $page->title }}</a>
                                </p>

                            @else
                        <p class="widget-about-desc">
                          <a href="{{ route('home.page',['page'=>$page->alias]) }}" class="widget-title cursor-pointer">{{ $page->title }}</a>
                        </p>
                        @endif

                        @endforeach
                    </div>
                </div>
                <div class="col-lg-5 col-sm-6">
                    <div class="widget">
                     <?php
                        $setting=\App\Models\Setting::first();
                        ?>
                        <a href="{{ route('home.index') }}" class="logo-footer mb-4">
                            <img class="text-center logo-footer-style"  src="{{ imageExist(env('LOGO_UPLOAD_PATH'),$setting->image) }}" alt="logo-footer" width="230"
                                 height="144"/>
                        </a>
                        <p style="justify-content:center" class="text-center d-flex mt-4">
                            <a style="margin-top: 4px;" referrerpolicy="origin" target="_blank" href="https://trustseal.enamad.ir/?id=310981&amp;Code=DohHIy95xD0qIIXMWrYo">
                                <img referrerpolicy="origin" src="https://Trustseal.eNamad.ir/logo.aspx?id=310981&amp;Code=DohHIy95xD0qIIXMWrYo" alt="" style="cursor:pointer" id="DohHIy95xD0qIIXMWrYo">
                                </a>
                            <img style="width:100px" onclick = 'window.open("https://logo.samandehi.ir/Verify.aspx?id=320714&p=xlaouiwkobpdjyoerfthaods", "Popup","toolbar=no, scrollbars=no, location=no, statusbar=no, menubar=no, resizable=0, width=450, height=630, top=30")' src="{{ asset('home/images/samandehi.png') }}">

                            <!--<img referrerpolicy='origin' id = 'rgvjnbqeesgtjzpejxlzwlao' style = 'cursor:pointer' onclick = 'window.open("https://logo.samandehi.ir/Verify.aspx?id=320714&p=xlaouiwkobpdjyoerfthaods", "Popup","toolbar=no, scrollbars=no, location=no, statusbar=no, menubar=no, resizable=0, width=450, height=630, top=30")' alt = 'logo-samandehi' src = 'https://logo.samandehi.ir/logo.aspx?id=320714&p=qftiodrflymayndtnbpdshwl' />-->
                        </p>

                    </div>
                </div>
                {{--
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title"></h4>
                        <p class="text-center">

                        </p>
                        <p  class="text-center">

                        </p>
                    </div>
                </div>
                --}}
            </div>
        </div>
        <div class="footer-middle">
            <div class="row">
                <div class="col-lg-12 col-sm-6">
                    <div class="widget widget-about">
                    <h3 class="widget-title2 text-right"> درباره پروفیل سازه:</h3>
                    <p  style="text-align:justify;">
                        {{ $setting->footer_about }}
                    </p>
                    </div>

                </div>
                <!--<div class="col-lg-6 col-sm-6">-->
                <!--    <div class="widget widget-about">-->
                <!--    <h3 class="widget-title">ما را دنبال کنید </h3>-->

                <!--        <div class="social-icons social-icons-colored"  style="text-align: center;">-->
                <!--            <a href="#" class="social-icon social-facebook w-icon-facebook"></a>-->
                <!--            <a href="#" class="social-icon social-twitter w-icon-twitter"></a>-->
                <!--            <a href="#" class="social-icon social-instagram w-icon-instagram"></a>-->

                <!--         </div>-->

                <!--</div>-->

                <!--</div>-->
            </div>
        </div>
             <div class="text-center">
                <h3 class="copyright">{{$setting->footer_4}}</h3><br/>
<div>

                <div class="text-center">
                    <h3 class="copyright" >{{$setting->footer_5}}</h3>
                </div>






<div class="text-center">
    <p style="margin-top:10px" class="copyright">طراحی و توسعه <a href="https://www.avatarweb.net" target="_blank">آواتار وب</a></p>
</div>
    </div>
</footer>
