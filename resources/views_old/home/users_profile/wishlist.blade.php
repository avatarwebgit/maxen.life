@extends('home.layouts.index')

@section('title')
    لیست علاقه مندی ها
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('home/css/profile_panel.css') }}">

    <style>
        table {
            width: 100%;
        }

        tr {
            border-bottom: 1px solid #eeeeee;
        }

        table th {
            text-align: center;
            padding: 20px;

        }

        table td {
            text-align: center;
            padding: 20px;

        }

        .fa-trash {
            color: red;
        }

        li {
            list-style: none !important;
        }

        #myaccountContent {
            margin-top: 0 !important;
        }

        td {
            vertical-align: middle !important;
        }

        @media screen and (max-width: 768px) {
            .table {
                width: 410px;
            }
        }

        .arrow-icons {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 1000px !important;
                margin: 1.75rem auto;
            }

            .arrow-icons {
                display: none;
            }
        }

        @media screen and (max-width: 768px) {
            .product-name-width {
                width: 700px;
            }
        }
    </style>
@endsection

@section('script')
    <script>
        $('.mobile-menu-toggle').click(function () {
            $('.loaded').addClass('mmenu-active');
        })
        $('.mobile-menu-close').click(function () {
            $('.loaded').removeClass('mmenu-active');
        })
        $('div#categories > ul.mobile-menu > li > a').append('<span class="toggle-btn"> </span>');
        $('div#categories > ul.mobile-menu > li > a').append('<span class="toggle-btn"> </span>');
        $('div#categories > ul.mobile-menu > li > a > span.toggle-btn').click(function (e) {
            e.preventDefault();
            $(this).parent().next().slideToggle(300).parent().toggleClass("show");
        })

        //remove from wishlist
        function RemoveFromProfileWishList(tag, event, productId) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('home.wishlist.remove') }}",
                type: "POST",
                dataType: "json",
                data: {
                    productId: productId,
                    _token: "{{ csrf_token() }}"
                },
                success: function (msg) {
                    if (msg[0] == 'ok') {
                        swal({
                            text: "محصول از لیست علاقه مندی های شما حذف شد",
                            icon: "success",
                            timer: 5000,
                            buttons: false,
                        })
                        window.location.reload();
                    }
                },
                error: function () {
                    console.log("something went wrong");
                },
            });
        }

        $('#mobile_menu_nav').click(function () {
            $('#icon-panel').toggleClass('negative');
            $('#icon-panel').toggleClass('positive');
            $('.negative').html('-');
            $('.positive').html('+');
        })
    </script>
@endsection

@section('content')
    <div class="my-account-wrapper main">
        <div class="container card">
            <div class="row card-body">
                <div class="col-lg-3 col-md-4">
                    @include('home.sections.profile_sidebar')
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="tab-content" id="myaccountContent">
                        <div class="myaccount-content">
                            @if($user->first_name==null or $user->national_code==null)
                                @include('home.users_profile.complete_info')
                            @else
                                <h3>لیست علاقه مندی ها</h3>
                                <div class="arrow-icons">
                                    <i class="fa fa-arrow-right"></i>
                                    <i class="fa fa-arrow-left"></i>
                                </div>
                                <div class="review-wrapper">
                                    @if($wishlist->isEmpty())
                                        <div class="alert alert-danger text-center">
                                            لیست علاقه مندی های شما خالی می باشد
                                        </div>
                                    @else
                                        <div class="table-content cart-table-content table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th scope="col"> تصویر محصول</th>
                                                    <th class="product-name-width" scope="col"> نام محصول</th>
                                                    <th scope="col"> حذف</th>
                                                    <th scope="col">افزودن به سبد خرید</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($wishlist as $item)
                                                    <tr>
                                                        <td class="product-thumbnail">
                                                            <a href="{{ route('home.product' , ['alias' => $item->product->alias]) }}">
                                                                <img width="100"
                                                                     src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $item->product->primary_image) }}"
                                                                     alt="">
                                                            </a>
                                                        </td>
                                                        <td class="product-name">
                                                            <a href="{{ route('home.product' , ['alias' => $item->product->alias]) }}">
                                                                {{ $item->product->name }}
                                                            </a>
                                                        </td>
                                                        <td class="product-name ">
                                                            <a onclick="RemoveFromProfileWishList(this,event,{{ $item->product->id }})">
                                                                <i class="fa fa-trash"
                                                                   style="font-size: 20px"></i> </a>

                                                        </td>
                                                        <td>
                                                            <button style="margin-right: 32%"
                                                                    onclick="AddToCart({{ $item->product->id }},1,0)"
                                                                    type="button"
                                                                    class="btn-product-icon btn-cart w-icon-cart"
                                                                    title="افزودن به سبد "></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
