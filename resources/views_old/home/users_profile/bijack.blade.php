@extends('home.layouts.index')

@section('title')
بارنامه
@endsection

@section('script')
<script>
             $('.mobile-menu-toggle').click(function(){
        $('.loaded').addClass('mmenu-active');
    })
    $('.mobile-menu-close').click(function(){
        $('.loaded').removeClass('mmenu-active');
    })
          $('div#categories > ul.mobile-menu > li > a').append('<span class="toggle-btn"> </span>');
   $('div#categories > ul.mobile-menu > li > a > span.toggle-btn').click(function(e){
        e.preventDefault();
       $(this).parent().next().slideToggle(300).parent().toggleClass("show");
       })

             $('#mobile_menu_nav').click(function(){
            $('#icon-panel').toggleClass('negative');
             $('#icon-panel').toggleClass('positive');
            $('.negative').html('-');
             $('.positive').html('+');
        })
</script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('home/css/profile_panel.css') }}">

    <style>
        .cursor-pointer {
            cursor: pointer;
        }
        table{
            overflow-x: scroll;
            width: 1000px;
            height:147px;
        }
        thead{
            height:78px;
        }

        td {
            font-size: 10pt;

            padding-right: 10px;
            vertical-align: middle;
        }
        h3.bijack{


    background: #5c8097;
    text-align: center;
    color: white;
    height: 57px;
  border-radius:8px;
    padding-top: 14px;
        }

        th {
            text-align: center;
        width: 178px;
        }

        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 1000px !important;
                margin: 1.75rem auto;
            }
        }

        .table-row:nth-child(even) {
            background-color: #f2f2f2 !important;
        }
        thead{
            background: #5c8097;
            color: #fff;
        }
        @media screen (max-width:768px){
            h3.bijack{
                    font-size: 32px;
            }
        }

        .bijack{

    font-size: 24px !important;

        }


    </style>
@endsection

@section('content')


    <div class="my-account-wrapper main">
        <div class="container card">
            <div class="row card-body">
                <div class="col-lg-3 col-md-4">
                    @include('home.sections.profile_sidebar')
                </div>
                <div class="col-lg-9 col-md-8">

                    <div class="tab-content" >
                        <h3 class="bijack">بارنامه (بیجک)</h3>
                        <div class="row">
                            <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">




                                {{--                                                <div class="row">--}}
                                {{--                                                    <div class="col-md-12">--}}


                                {{--                                                        <div class="table-responsive">--}}


                                {{--                                                            @if($order->bijack != null && $order_bijack->phone_origin && $order_bijack->date )--}}
                                {{--                                                                <table  class="mt10">--}}
                                {{--                                                                    <thead>--}}
                                {{--                                                                    <tr>--}}
                                {{--                                                                        <th >--}}
                                {{--                                                                             گیرنده :--}}
                                {{--                                                                        </th>--}}
                                {{--                                                                        <th>--}}
                                {{--                                                                            شماره بارنامه :--}}
                                {{--                                                                        </th>--}}
                                {{--                                                                        <th>--}}
                                {{--                                                                            تاریخ :--}}
                                {{--                                                                        </th>--}}
                                {{--                                                                        <th >--}}
                                {{--                                                                            نام باربری مبداء :--}}
                                {{--                                                                        </th>--}}
                                {{--                                                                        <th >--}}
                                {{--                                                                            شماره باربری مبداء :--}}
                                {{--                                                                        </th>--}}
                                {{--                                                                        <th >--}}
                                {{--                                                                            نام باربری مقصد :--}}
                                {{--                                                                        </th>--}}
                                {{--                                                                        <th >--}}
                                {{--                                                                            شماره باربری مقصد :--}}
                                {{--                                                                        </th>--}}

                                {{--                                                                    </tr>--}}
                                {{--                                                                    </thead>--}}
                                {{--                                                                    <tbody>--}}
                                {{--                                                                    <tr>--}}
                                {{--                                                                        <td>--}}
                                {{--                                                                            {{ $order_bijack->name}}--}}
                                {{--                                                                        </td>--}}
                                {{--                                                                        <td>--}}
                                {{--                                                                            {{ $order_bijack->barname}}--}}
                                {{--                                                                        </td>--}}
                                {{--                                                                        <td style="width: 156px">--}}
                                {{--                                                                            {{verta($order_bijack->date)->format('%d %B، %Y') }}--}}
                                {{--                                                                        </td>--}}
                                {{--                                                                        <td>--}}
                                {{--                                                                            {{ $order_bijack->origin}}--}}
                                {{--                                                                        </td>--}}
                                {{--                                                                        <td>--}}
                                {{--                                                                            {{ $order_bijack->phone_origin}}--}}
                                {{--                                                                        </td>--}}
                                {{--                                                                        <td>--}}
                                {{--                                                                            {{ $order_bijack->Destination}}--}}
                                {{--                                                                        </td>--}}
                                {{--                                                                        <td>--}}
                                {{--                                                                            {{ $order_bijack->phone_Destination}}--}}
                                {{--                                                                        </td>--}}

                                {{--                                                                    </tr>--}}
                                {{--                                                                    </tbody>--}}
                                {{--                                                                </table>--}}
                                {{--                                                            @endif--}}

                                {{--                                                        </div>--}}
                                {{--                                                    </div>--}}
                                {{--                                                </div>--}}
                                <div class="row">
                                    <div class="col-12">
                                        @if($order->bijack != null && $order_bijack->phone_origin && $order_bijack->date )
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label> گیرنده:</label>
                                                    <input class="form-control" type="text"
                                                           value=" {{ $order_bijack->name}}" disabled>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>شماره بارنامه:</label>
                                                    <input class="form-control" type="text"
                                                           value="{{ $order_bijack->barname}}" disabled>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label> تاریخ:</label>
                                                    <input class="form-control" type="text"
                                                           value="{{verta($order_bijack->date)->format('%d %B %Y') }}"
                                                           disabled>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>نام باربری مبداء:</label>
                                                    <input class="form-control" type="text"
                                                           value="{{ $order_bijack->origin}}"
                                                           disabled>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label> شماره باربری مبداء:</label>
                                                    <input class="form-control" type="text"
                                                           value="{{ $order_bijack->phone_origin}}"
                                                           disabled>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label>نام باربری مقصد:</label>
                                                    <input class="form-control" type="text"
                                                           value="{{ $order_bijack->Destination}}"
                                                           disabled>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>شماره باربری مقصد:</label>
                                                    <input class="form-control" type="text"
                                                           value="{{ $order_bijack->phone_Destination}}"
                                                           disabled>
                                                </div>













                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <a href="{{ route('home.orders.users_profile.index') }}"
                                   class="btn btn-rounded btn-gold mt-5">بازگشت</a>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
