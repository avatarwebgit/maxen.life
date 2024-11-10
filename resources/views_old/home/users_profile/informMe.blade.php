@extends('home.layouts.index')

@section('title')
    در انتظار موجودی
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
        $('div#categories > ul.mobile-menu > li > a > span.toggle-btn').click(function (e) {
            e.preventDefault();
            $(this).parent().next().slideToggle(300).parent().toggleClass("show");
        })

        //remove from wishlist
        function RemoveFromInformMeList(tag, event, id) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('home.profile.informMe.remove') }}",
                type: "POST",
                dataType: "json",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function (msg) {
                    if (msg[0] == 'ok') {
                        swal({

                            text: "محصول از لیست در انتظار موجودی حذف شد",
                            icon: "success",
                            timer: 5000,
                            buttons: false,
                        })

                        // window.location.reload();
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
                                <h3>در انتظار موجودی</h3>
                                <div class="arrow-icons">
                                    <i class="fa fa-arrow-right"></i>
                                    <i class="fa fa-arrow-left"></i>
                                </div>
                                <div class="review-wrapper">
                                    @if($products->isEmpty())
                                        <div class="alert alert-danger text-center">
                                            لیست در انتظار موجودی شما خالی می باشد
                                        </div>
                                    @else
                                        <div style="overflow:scroll"
                                             class="table-content cart-table-content table-responsive-sm">
                                            <table style="width:898px" class="table">
                                                <thead>
                                                <tr>
                                                    <th> تصویر محصول</th>
                                                    <th style="width: 609px;"> نام محصول</th>
                                                    <th> حذف</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                @foreach ($products as $item)
                                                    @if(isset($item->Product))
                                                    <tr>
                                                        <td class="product-thumbnail">
                                                            <a href="{{ route('home.product' , ['alias' => $item->Product->alias]) }}">
                                                                <img width="100"
                                                                     src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $item->product->primary_image) }}"
                                                                     alt="">
                                                            </a>
                                                        </td>
                                                        <td class="product-name">
                                                            <a href="{{ route('home.product' , ['alias' => $item->Product->alias]) }}">
                                                                {{ $item->Product->name }}
                                                            </a>
                                                        </td>
                                                        <td class="product-name">
                                                            <a onclick="RemoveFromInformMeList(this,event,{{ $item->id }})">
                                                                <i class="fa fa-trash"
                                                                   style="font-size: 20px"></i> </a>
                                                        </td>
                                                    </tr>
                                                    @endif
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
