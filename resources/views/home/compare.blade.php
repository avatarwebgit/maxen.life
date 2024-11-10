@extends('home.layouts.index')

@section('title')
    مقایسه محصولات
@endsection

@section('description')
@endsection

@section('keywords')
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
        $('div#categories > ul.mobile-menu > li > a').append('<span class="toggle-btn"> </span>');
        $('div#categories > ul.mobile-menu > li > a > span.toggle-btn').click(function(e){

            e.preventDefault();
            $(this).parent().next().slideToggle(300).parent().toggleClass("show");
        })

        function open_tab_group(tag, attr_group_id) {
            $('.attr_group_table_' + attr_group_id).slideToggle(500);
            $(tag).find('.left_icon').toggleClass('d-none');
            $(tag).find('.down_icon').toggleClass('d-none');
        }
    </script>
@endsection

@section('style')
    <style>
    @media(max-width:992px){
           .margin-0{
        margin:0 !important;
    }
    
    }
 
    @media only screen and (max-width: 991px) {
    .section-margin {
        margin-top: 62px;
        margin-bottom: 20px;
    }
}
        th {
            text-align: center;
        }

        @media screen and (max-width:780px){
            .name-compare{
                height:162px;
            }
        }

        td {
            text-align: center;

            padding: 5px;
        }

        img {
            width: 400px;
            height: auto;
        }

        thead {
            height: 70px;
        }
        .color-green{
            color: green !important;
        }
        .main-logo p {
            font-size: 16px;
            margin-top: 2%;
            margin-left: -3px;
            float:left;
        }
        .main-logo img{
            height:auto !important;
            width:100%;
        }
        .site-header .inner-header .main-logo {
            width: 250px !important;
        }
        .section-attributes{
            padding: 0 5%;
        }
 .product-attribute:first-of-type .header-product-attribute{
            border-top:none;
        }
        /*.product-attribute {*/
        /*    border-top: 2px solid #ccc;*/
        /*}*/
        .title-product {
            padding: 10px 0;
            cursor: pointer;
        }
        @media (min-width: 992px) {
            .d-lg-none {
                display: none;
            }
        }
        .arrow_icon {
            width: 20px;
            height: 20px;
        }
        .d-none {
            display: none;
        }
        .product-attribute ul li {
            padding: 15px;

            color: #000;
        }
        .product-attribute ul li span {
            margin: 0 20px;
        }
        /*.product-attribute {*/
        /*    border-top: 2px solid #ccc;*/
        /*}*/

        .border-top{
            border-top: 2px solid #ccc;
        }
        /*.product-attribute ul li:last-of-type {*/
        /*    border-bottom: none;*/
        /*}*/

        .attr_children{
            border-bottom: 2px solid #ccc;
        }
        /*.product-attribute .attr_children:last-of-type {*/
        /*    border-bottom: none;*/
        /*}*/
        .border-bottom-none{
            border-bottom: none !important;
        }

        .no-padding{
            padding: 10px 0 !important;
        }
        .margin-0{
            margin: 0 !important;
        }


        @media (max-width:767px){
            h4 {
                font-size: 15px;
            }
            .card-header{
                padding-top: 12%;
            }

        }
        @media (min-width: 992px) {
            .d-lg-flex {
                display: -ms-flexbox;
                display: flex;
            }
        }
    </style>
@endsection

@section('content')
    <div class="wrapper">
        <section  class="product-section section-margin">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-center justify-content-md-normal">
                            <div class="col-4 col-lg-1 d-none d-md-block"></div>
                            @foreach ($products as $item)
                            <div class="col-{{ceil(8/count($products))}} ">
                                <div class="d-flex justify-content-center align-items-center flex-column">
                                    @if(file_exists(public_path(env('PRODUCT_IMAGES_UPLOAD_PATH').$item->primary_image))
              and !is_dir(public_path(env('PRODUCT_IMAGES_UPLOAD_PATH').$item->primary_image)))
                                        <img
                                            src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $item->primary_image) }}"
                                            alt="">
                                    @else
                                        <img src="{{ asset('admin/images/no_image.jpg') }}" alt="">
                                    @endif
                                    <div class="product-title  text-right">
                                        <h4>{{$item->title_2}} <span style="font-weight:500">{{$item->title_1}}</span> </h4>
                                        <h4>{{$item->name}}</h4>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-12 ">
                            <p> {{__('Main features')}}</p>
                        </div>


                   @foreach($attr_group as $key_group => $attributes)
                            @foreach($attributes as $key=> $attribute)
                                <div  class="col-12 margin-0 product-attribute row {{$key == 0 ? 'border-top' : ''}}">

                                    <div class="col-12 d-flex d-lg-block justify-content-center justify-content-lg-between align-items-center col-lg-1">
                                      @if($key == 0)
                                            <p onclick="open_tab_group(this,{{ $key_group }})" class="title-product">               {{ app()->getLocale() == 'fa' ? $attribute->Group->name  :  $attribute->Group->name_en }}</p>
                                            <div class=" d-flex d-lg-none ">
                                                <img class="arrow_icon left_icon {{ $key==0 ? 'd-none' : '' }}"
                                                     src="{{ asset('home/img/left.png') }}">
                                                <img class="arrow_icon down_icon {{ $key==0 ? '' : 'd-none' }}"
                                                     src="{{ asset('home/img/down.png') }}">
                                            </div>
                                        @endif


                                    </div>

                                    <div   class="col-12 attr_group_table_{{ $key_group }} col-lg-10  {{ $loop->last ? 'border-bottom-none' :  ' ' }} attr_children ">
                                        <ul >
                                            <li  class="row d-none d-lg-flex">
                                                @foreach ($products as $key=> $item)
                                                    @if($key == 0)
                                                        <div class="col-2">
                                                            <span>{{ app()->getLocale() == 'fa' ? ($attribute->name ?? '-' )  : $attribute->name_en}}</span>
                                                        </div>
                                                    @endif

                                                        <?php
                                                        $product_attribute = \App\Models\ProductAttribute::where('attribute_id', $attribute->id)
                                                            ->where('product_id', $item->id)->first();



                                                        if($product_attribute!=null){
                                                            $attribute_values=$product_attribute->attributeValues($product_attribute->value,$product_attribute->attribute_id);
                                                        }else{
                                                            $attribute_values=null;
                                                        }
                                                        ?>



                                                    <div class="col">



                                                  <span>
                                                                    @if($attribute_values==null)
                                                          @if($product_attribute==null)
                                                              -
                                                          @else
                                                              {{ $product_attribute->value }}
                                                          @endif
                                                      @else
                                                          {{ app()->getLocale() == 'fa' ? $attribute_values->name :  $attribute_values->name_en}}
                                                      @endif
                                                        </span>
                                                    </div>


                                                @endforeach
                                            </li>

                                            <li   class="row no-padding  d-lg-none">
                                                @foreach ($products as $key=> $item)
                                                    @if($key == 0)
                                                        <div class="col-2 text-right">
                                                            <span class="margin-0">{{ app()->getLocale() == 'fa' ? ($attribute->name ?? '-' )  : $attribute->name_en}}</span>
                                                        </div>
                                                    @endif
                                                @endforeach





                                                    <div  class="col-10 justify-content-around d-flex">

                                                        @foreach ($products as $key=> $item)
                                                                <?php
                                                                $product_attribute = \App\Models\ProductAttribute::where('attribute_id', $attribute->id)
                                                                    ->where('product_id', $item->id)->first();



                                                                if($product_attribute!=null){
                                                                    $attribute_values=$product_attribute->attributeValues($product_attribute->value,$product_attribute->attribute_id);
                                                                }else{
                                                                    $attribute_values=null;
                                                                }
                                                                ?>

                                                  <span class="margin-0">
                                                                    @if($attribute_values==null)
                                                          @if($product_attribute==null)
                                                              -
                                                          @else
                                                              {{ $product_attribute->value }}
                                                          @endif
                                                      @else
                                                          {{ app()->getLocale() == 'fa' ? $attribute_values->name :  $attribute_values->name_en }}
                                                      @endif
                                                        </span>
                                                        @endforeach
                                                    </div>



                                            </li>

                                        </ul>

                                    </div>
                                    @if($key == 0)
                                    <div class="col-1  d-lg-flex justify-content-center align-items-center">
                                        <img class="arrow_icon left_icon {{ $key==0 ? '' : 'd-none' }}"
                                             src="{{ asset('home/img/left.png') }}">
                                        <img class="arrow_icon down_icon {{ $key==0 ? 'd-none' : '' }}"
                                             src="{{ asset('home/img/down.png') }}">
                                    </div>
                                    @endif

                                </div>
                            @endforeach

                        @endforeach

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
