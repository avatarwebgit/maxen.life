<!DOCTYPE html>
<html lang="fa">
<!--begin::Head-->
<head><base href="../../../"/>
    <title>Login</title>
    <meta charset="utf-8" />


    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/cssfamily=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{asset('metronik/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('metronik/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .lcc-modal{
            display: none !important;
        }
    </style>
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat">
<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches  "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
<!--end::Theme mode setup on page load-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Page bg image-->
    <style>body { background-image: url('metronik/LoginBack.jpg'); } [data-bs-theme="dark"] body { background-image: url('assets/media/auth/bg4-dark.jpg'); }</style>
    <!--end::Page bg image-->
    <!--begin::Authentication - ورود -->
    <div class="d-flex flex-column flex-column-fluid flex-lg-row">
        <!--begin::Aside-->
        <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
            <!--begin::Aside-->
            <div class="d-flex flex-center flex-lg-start flex-column">
                <!--begin::Logo-->
                <a href="https://avatarweb.net" class="mb-7">
                    <img width="200" alt="Logo" src="metronik/Logo-p.png" />
                </a>
                <!--end::Logo-->
                <!--begin::Title-->

                <!--end::Title-->
            </div>
            <!--begin::Aside-->
        </div>
        <!--begin::Aside-->
        <!--begin::Body-->
        <div  class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
            <!--begin::Card-->
            <div style="    height: 50vh !important;
    margin: auto;" class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
                <!--begin::Wrapper-->
                <div  class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                    <!--begin::Form-->
                    <form class="form w-100" novalidate="novalidate"  method="post" action="{{route('login.dashboard.admin')}}">
                    @csrf

                    <!--begin::Heading-->
                        <div class="text-center mb-11">
                            <!--begin::Title-->
                            <h1 class="text-dark fw-bolder mb-3">ورود به پنل مدیریت</h1>

                        </div>


                        <!--end::Separator-->
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <!--begin::Email-->
                            <input type="text" placeholder="نام کاربری" name="username" autocomplete="off" class="form-control bg-transparent" />
                            <!--end::Email-->
                        </div>
                        <!--end::Input group=-->
                        <div class="fv-row mb-3">
                            <!--begin::کلمه عبور-->
                            <input type="password" placeholder="کلمه عبور" name="password" autocomplete="off" class="form-control bg-transparent" />
                            <!--end::کلمه عبور-->
                        </div>

                        <div class="d-grid mb-10">
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">ورود</span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                <!--end::Indicator progress-->
                            </button>
                        </div>

                    </form>
                    <!--end::Form-->
                </div>

            </div>
            <!--end::Card-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - ورود-->
</div>
<!--end::Root-->
<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{asset('metronik/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('metronik/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{asset('metronik/js/custom/authentication/sign-in/general.js')}}"></script>
<!--end::Custom Javascript-->


@if(session('success'))
    <script>
        Swal.fire({
            title: 'موفقیت!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'باشه'
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            title: 'خطا!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'باشه'
        });
    </script>
@endif

</body>
<!--end::Body-->
</html>
