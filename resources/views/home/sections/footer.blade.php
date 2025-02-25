@php
    $pages_g=\App\Models\Page::where('id','!=',11)->orderBy('priority','asc')->get()->chunk(3);
@endphp
<footer class="footer-1 p-relative ">
    <div class="container-fluid">
        <div class="footer-links p-relative">
            <div class="row row-custom">
                <div class="col-lg-12 col-md-12 mb-5 footer-block-inner">
                    <div class="w-100 divider-line-footer">

                    </div>
                </div>


                <div class="col-lg-2 col-md-6 footer-block-inner">
                    <div class="footer-block col-menu">
                        <h4 class="footer-title-2"> {{app()->getLocale() == 'fa' ? $setting->footer_1 : $setting->footer_1_en}}</h4>

                        <div class="footer-social mt-3 p-relative">
                            <ul>
                                              <?php
                $categories = \App\Models\Category::where('parent_id', 0)->where('is_active',1)->orderby('priority','asc')->latest()->take(5)->get();
                ?>
                           @foreach($categories as $cat)
                                <li class="over-hidden">
                                    <a href="{{ route('home.product_categories',['category'=>$cat->alias]) }}" data-dsn="parallax" target="_blank" rel="nofollow">{{ app()->getLocale() == 'fa' ?  $cat->name  : $cat->name_en  }}({{$cat->Products->count()}})</a>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col-lg-2 col-md-6 footer-block-inner">
                    <div class="footer-block col-menu">
                        <h4 class="footer-title-2">{{__('MAXEN')}}</h4>

                        <div class="footer-social mt-3 p-relative">
                            <ul>

                                                 @foreach($pages_g[0] as $page)

                                        <li class="over-hidden">
                                            <a href="{{ route('home.page',['page'=>$page->alias]) }}" data-dsn="parallax" target="_blank" rel="nofollow">{{ app()->getLocale() == 'fa' ? $page->title : $page->title_en }}</a>
                                        </li>

  @endforeach


                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col-lg-2 col-md-6 footer-block-inner">
                    <div class="footer-block col-menu">
                        <h4 class="footer-title-2"> {{ app()->getLocale() == 'fa' ? $setting->footer_3 : $setting->footer_3_en }}</h4>

                        <div class="footer-social mt-3 p-relative">
                                             <ul>
                                        @foreach($pages_g[1] as $page)

                                    @if($page->id == 6)
                                        <li class="over-hidden">
                                            <a href="{{ route('home.contact') }}" data-dsn="parallax" target="_blank" rel="nofollow">{{ app()->getLocale() == 'fa' ? $page->title : $page->title_en }}</a>
                                        </li>

                                    @else
                                        <li class="over-hidden">
                                            <a href="{{ route('home.page',['page'=>$page->alias]) }}" data-dsn="parallax" target="_blank" rel="nofollow">{{ app()->getLocale() == 'fa' ? $page->title : $page->title_en }}</a>
                                        </li>
                                    @endif

                         @endforeach
                           <li class="over-hidden">
                                            <a href="https://maxen.life/DL/MAXEN-CATALOG.pdf" data-dsn="parallax" target="_blank" rel="nofollow">{{ __('Catalogue') }}</a>
                                        </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 footer-block-inner">
                    <div class="footer-block">
                        <div class="d-flex flex-column justify-content-between">

                            <form method="post" action="{{route('join.news')}}" class="flex-column justify-content-between">
                                @csrf


                                <p class="my-3"> {{app()->getLocale() == 'fa' ? $setting->footer_2 : $setting->footer_2_en}}</p>
                                <div class="form-group mb-3">
                                    <input class="form-control
 w-100" name="email" type="email" placeholder="{{__('Email')}} ">
 @error('email')
 <span>لطفا ایمیل را به شکل صحیح وارد کنید</span>
 @enderror
                                </div>
                                <div class="form-group">
                                    <button class=" btn-dark text-white" >{{__('Send Email')}}</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div  class="copyright">
        <div class="text-center d-flex align-items-center flex-column flex-lg-row justify-content-around">
            <div>
                <ul class="d-flex justify-content-center align-items-center flex-row-reverse">
                    <li class="mr-2">
                        <a href="{{$setting->linkedin}}">
<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50" style="width:36px">
    <path d="M25,2C12.318,2,2,12.317,2,25s10.318,23,23,23s23-10.317,23-23S37.682,2,25,2z M18,35h-4V20h4V35z M16,17 c-1.105,0-2-0.895-2-2c0-1.105,0.895-2,2-2s2,0.895,2,2C18,16.105,17.105,17,16,17z M37,35h-4v-5v-2.5c0-1.925-1.575-3.5-3.5-3.5 S26,25.575,26,27.5V35h-4V20h4v1.816C27.168,20.694,28.752,20,30.5,20c3.59,0,6.5,2.91,6.5,6.5V35z"></path>
</svg>
                        </a>
                    </li>
                    <li class="mr-2">
                        <a href="{{$setting->youtube}}">
         <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 58.536 58.536">
  <path id="Path_177" data-name="Path 177" d="M596.5,65.707l10.138-5.854L596.5,54Z" transform="translate(-571.13 -30.586)" fill="#040504"/>
  <path id="Path_178" data-name="Path 178" d="M567.264,0a29.268,29.268,0,1,0,29.268,29.268A29.267,29.267,0,0,0,567.264,0m18.7,38.661a4.887,4.887,0,0,1-3.45,3.45c-3.043.816-15.246.816-15.246.816s-12.2,0-15.247-.816a4.887,4.887,0,0,1-3.45-3.45c-.815-3.043-.815-9.393-.815-9.393s0-6.35.815-9.393a4.888,4.888,0,0,1,3.45-3.45c3.043-.815,15.247-.815,15.247-.815s12.2,0,15.246.815a4.888,4.888,0,0,1,3.45,3.45c.816,3.043.816,9.393.816,9.393s0,6.349-.816,9.393" transform="translate(-537.996)" fill="#040504"/>
</svg>



                        </a>
                    </li>
                    <li class="mr-2">
                        <a href="{{$setting->twitter}}">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="100" height="100" viewBox="0 0 256 256" xml:space="preserve">

<defs>
</defs>
<g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
	<polygon points="24.89,23.01 57.79,66.99 65.24,66.99 32.34,23.01 " style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) "/>
	<path d="M 45 0 L 45 0 C 20.147 0 0 20.147 0 45 v 0 c 0 24.853 20.147 45 45 45 h 0 c 24.853 0 45 -20.147 45 -45 v 0 C 90 20.147 69.853 0 45 0 z M 56.032 70.504 L 41.054 50.477 L 22.516 70.504 h -4.765 L 38.925 47.63 L 17.884 19.496 h 16.217 L 47.895 37.94 l 17.072 -18.444 h 4.765 L 50.024 40.788 l 22.225 29.716 H 56.032 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
</g>
</svg>

                        </a>
                    </li>
                    <!--<li class="mr-2">-->
                    <!--    <a>-->
                    <!--        <svg xmlns="http://www.w3.org/2000/svg" width="58.536" height="58.536" viewBox="0 0 58.536 58.536">-->
                    <!--            <path id="Path_177" data-name="Path 177" d="M596.5,65.707l10.138-5.854L596.5,54Z" transform="translate(-571.13 -30.586)" fill="#040504"/>-->
                    <!--            <path id="Path_178" data-name="Path 178" d="M567.264,0a29.268,29.268,0,1,0,29.268,29.268A29.267,29.267,0,0,0,567.264,0m18.7,38.661a4.887,4.887,0,0,1-3.45,3.45c-3.043.816-15.246.816-15.246.816s-12.2,0-15.247-.816a4.887,4.887,0,0,1-3.45-3.45c-.815-3.043-.815-9.393-.815-9.393s0-6.35.815-9.393a4.888,4.888,0,0,1,3.45-3.45c3.043-.815,15.247-.815,15.247-.815s12.2,0,15.246.815a4.888,4.888,0,0,1,3.45,3.45c.816,3.043.816,9.393.816,9.393s0,6.349-.816,9.393" transform="translate(-537.996)" fill="#040504"/>-->
                    <!--        </svg>-->



                    <!--    </a>-->
                    <!--</li>-->
                    <li class="mr-2">
                        <a href="{{$setting->instagram}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 58.536 58.536">
                                <path id="Path_174" data-name="Path 174" d="M776.8,53.333a6.143,6.143,0,1,0,6.143,6.143,6.143,6.143,0,0,0-6.143-6.143" transform="translate(-747.536 -30.208)" fill="#040504"/>
                                <path id="Path_175" data-name="Path 175" d="M779.459,36.9a6.108,6.108,0,0,0-3.5-3.5,10.209,10.209,0,0,0-3.422-.634c-1.943-.088-2.526-.108-7.447-.108s-5.5.019-7.446.108a10.21,10.21,0,0,0-3.422.634,6.1,6.1,0,0,0-3.5,3.5,10.2,10.2,0,0,0-.634,3.422c-.089,1.943-.108,2.526-.108,7.447s.019,5.5.108,7.446a10.2,10.2,0,0,0,.634,3.422,6.1,6.1,0,0,0,3.5,3.5,10.2,10.2,0,0,0,3.422.634c1.943.089,2.526.108,7.446.108s5.5-.019,7.447-.108a10.2,10.2,0,0,0,3.422-.634,6.1,6.1,0,0,0,3.5-3.5,10.2,10.2,0,0,0,.634-3.422c.088-1.943.108-2.526.108-7.446s-.019-5.5-.108-7.447a10.2,10.2,0,0,0-.634-3.422M765.093,57.228a9.463,9.463,0,1,1,9.463-9.463,9.463,9.463,0,0,1-9.463,9.463m9.837-17.089a2.211,2.211,0,1,1,2.211-2.211,2.211,2.211,0,0,1-2.211,2.211" transform="translate(-735.825 -18.497)" fill="#040504"/>
                                <path id="Path_176" data-name="Path 176" d="M746.6,0a29.268,29.268,0,1,0,29.268,29.268A29.268,29.268,0,0,0,746.6,0m18.317,36.866a13.524,13.524,0,0,1-.856,4.473,9.425,9.425,0,0,1-5.39,5.39,13.529,13.529,0,0,1-4.473.857c-1.965.089-2.593.111-7.6.111s-5.632-.021-7.6-.111a13.524,13.524,0,0,1-4.473-.857,9.422,9.422,0,0,1-5.39-5.39,13.523,13.523,0,0,1-.857-4.473c-.089-1.966-.111-2.593-.111-7.6s.021-5.632.111-7.6a13.528,13.528,0,0,1,.857-4.473,9.422,9.422,0,0,1,5.39-5.39A13.525,13.525,0,0,1,739,10.951c1.966-.09,2.593-.111,7.6-.111s5.632.021,7.6.111a13.531,13.531,0,0,1,4.473.856,9.425,9.425,0,0,1,5.39,5.39,13.529,13.529,0,0,1,.856,4.473c.09,1.966.111,2.593.111,7.6s-.021,5.632-.111,7.6" transform="translate(-717.328)" fill="#040504"/>
                            </svg>




                        </a>
                    </li>
                    <li class="mr-2">
                        <a href="{{$setting->aparat}}" >
                            <svg style="background: #000000;border-radius: 50%" width="45px" fill="#ffffff" viewBox="-2.4 -2.4 28.80 28.80" role="img" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff" stroke-width="0.00024000000000000003" transform="rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.24000000000000005"></g><g id="SVGRepo_iconCarrier"><path d="M12.001 1.594c-9.27-.003-13.913 11.203-7.36 17.758a10.403 10.403 0 0 0 17.76-7.355c0-5.744-4.655-10.401-10.4-10.403zM6.11 6.783c.501-2.598 3.893-3.294 5.376-1.103 1.483 2.19-.422 5.082-3.02 4.582A2.97 2.97 0 0 1 6.11 6.783zm4.322 8.988c-.504 2.597-3.897 3.288-5.377 1.096-1.48-2.192.427-5.08 3.025-4.579a2.97 2.97 0 0 1 2.352 3.483zm1.26-2.405c-1.152-.223-1.462-1.727-.491-2.387.97-.66 2.256.18 2.04 1.334a1.32 1.32 0 0 1-1.548 1.053zm6.198 3.838c-.501 2.598-3.893 3.293-5.376 1.103-1.484-2.191.421-5.082 3.02-4.583a2.97 2.97 0 0 1 2.356 3.48zm-1.967-5.502c-2.598-.501-3.293-3.896-1.102-5.38 2.19-1.483 5.081.422 4.582 3.02a2.97 2.97 0 0 1-3.48 2.36zM13.59 23.264l2.264.61a3.715 3.715 0 0 0 4.543-2.636l.64-2.402a11.383 11.383 0 0 1-7.448 4.428zm7.643-19.665L18.87 2.97a11.376 11.376 0 0 1 4.354 7.62l.65-2.459A3.715 3.715 0 0 0 21.231 3.6zM.672 13.809l-.541 2.04a3.715 3.715 0 0 0 2.636 4.543l2.107.562a11.38 11.38 0 0 1-4.203-7.145zM10.357.702 8.15.126a3.715 3.715 0 0 0-4.547 2.637l-.551 2.082A11.376 11.376 0 0 1 10.358.702z"></path></g></svg>                </ul>

            </div>
            <div style="font-family: 'Nunito', sans-serif;direction: ltr" class="copright-text over-hidden">
               {{app()->getLocale() == 'fa' ? $setting->footer_5 : $setting->footer_5_en}}
            </div>

        </div>
    </div>
</footer>
