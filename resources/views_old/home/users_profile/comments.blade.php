@extends('home.layouts.index')

@section('title')
    دیدگاه ها
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('home/css/profile_panel.css') }}">

    <style>
        li {
            list-style: none !important;
        }

        #myaccountContent {
            margin-top: 0 !important;
        }

        td {
            vertical-align: middle;
        }

        @media screen and (max-width: 992px) {
            .overflow-x-mobile {
                overflow-x: scroll;

            }
        }

        @media screen and (max-width: 768px) {
            table {
                width: 500px;
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
                                <h3>
                                    دیدگاه ها
                                </h3>
                                <div class="arrow-icons">
                                    <i class="fa fa-arrow-right"></i>
                                    <i class="fa fa-arrow-left"></i>
                                </div>
                                {{--                                            @if(empty($comment_index))--}}
                                {{--                                                <div class="col-12 d-flex justify-content-end mb-3">--}}
                                {{--                                                    <a href="{{ route('home.comment.create') }}"--}}
                                {{--                                                       class="btn btn-sm btn-success">جدید</a>--}}
                                {{--                                                </div>--}}
                                {{--                                            @endif--}}
                                <div class="review-wrapper">
                                    @if (empty($comments))
                                        <div class="alert alert-danger text-center">
                                            تاکنون دیدگاهی ثبت نکرده اید
                                        </div>
                                    @else
                                        @if (!empty($comments))
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-bordered overflow-x-mobile text-center mb-5">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>محصول</th>
                                                        <th>متن</th>
                                                        <th>وضعیت</th>
                                                        <th>تاریخ</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($comments as $comment)
                                                        <tr>
                                                            <td class="product-thumbnail">
                                                                <a href="{{ route('home.product' , ['alias' => $comment->product->alias]) }}">
                                                                    <img width="100"
                                                                         src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $comment->product->primary_image) }}"
                                                                         alt="">
                                                                </a>
                                                            </td>
                                                            <td> {{ $comment->text }} </td>
                                                            <td>{{ $comment->approved }}</td>
                                                            <td>{{ verta($comment->created_at)->format('%d %B Y') }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
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
