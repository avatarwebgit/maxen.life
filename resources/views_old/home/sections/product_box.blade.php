
@foreach($products as $product)
@php
 if(!isset($col)){
     $col = '';
 }

@endphp
    <div class="product-wrap {{$col}}">
        <div class="product text-center position-relative">
            @if(count($product->ProductAttributeVariation($product->id))>0)
                <div class="product-pa-wrapper product_colors">
                    @foreach($product->ProductAttributeVariation($product->id) as $variation)
                        <span>
                                                    <img class="img-variations"
                                                         src="{{ imageExist(env('ATTR_UPLOAD_PATH'),$variation->Color->image) }}">
                                                </span>
                    @endforeach
                </div>
            @endif
            <div class="product-label">
                @if($product->label>0)
                    <span class="custom_label"
                          style="background-color: {{ $product->Label->color }}">{{ $product->Label->name }}</span>
                @endif
            </div>
            <figure class="product-media">
                  @if($product->quantity>0)
                @if(product_price_for_user_normal($product->id)[1]!=0)
                    <span class="product_list_discount">{{ number_format(product_price_for_user_normal($product->id)[1]).' % ' }}</span>
                @endif
                @endif
                <a href="{{ route('home.product',['alias'=>$product->alias]) }}">
                    <img
                        src="{{ imageExist(env('PRODUCT_IMAGES_THUMBNAIL_UPLOAD_PATH'),$product->primary_image) }}"
                        alt="Product" width="300"
                        height="338"/>
                        <?php
                        $productImage = \App\Models\ProductImage::where('product_id', $product->id)->where('set_as_second_image', 1)->first();
                        if ($productImage==null){
                            $productImage = \App\Models\ProductImage::where('product_id', $product->id)->where('set_as_second_image', 0)->first();
                        }
                        ?>
                    @if($productImage!=null)
                        <img
                            src="{{ imageExist(env('PRODUCT_IMAGES_THUMBNAIL_UPLOAD_PATH'),$productImage->image) }}"
                            alt="Product" width="300" height="338"/>
                    @endif
                </a>
                <div class="product-action-horizontal">
                          <a href="{{ route('home.product',['alias'=>$product->alias]) }}"
                       class="btn-product-icon w-icon-visit"
                       title="نمایش"></a>
                        @if($product->quantity>0)
                    <button onclick="AddToCart({{ $product->id }},1,0)"
                            type="button"
                            class="btn-product-icon btn-cart w-icon-cart"
                            title="  افزودن به سبد خرید "></button>
                            @endif
                            <a onclick="AddToCompareList(event,{{ $product->id }})"
                       class="btn-product-icon w-icon-compare"
                       title="افزودن به لیست مقایسه"></a>
                    @if($product->quantity==0)
                        <button type="button"
                                onclick="informMe({{ $product->id }})"
                                class="btn-product-icon fas fa-bell"
                                title="موجود شد به من اطلاع بده"></button>
                    @endif
                    @auth
                        @if ($product->checkUserWishlist(auth()->id()))
                            <a title="حذف از علاقه مندی ها"
                               class="btn-product-icon btn-wishlist w-icon-heart-full"
                               onclick="RemoveFromWishList(this,event,{{ $product->id }})"
                               href="#">
                            </a>
                        @else
                            <a title="افزودن به علاقه مندی ها"
                               class="btn-product-icon btn-wishlist w-icon-heart"
                               onclick="AddToWishList(this,event,{{ $product->id }})">
                            </a>
                        @endif
                    @else
                        <a title="افزودن به علاقه مندی ها"
                           class="btn-product-icon btn-wishlist w-icon-heart"
                           onclick="AddToWishList(this,event,{{ $product->id }})">
                        </a>
                    @endauth
              
                    
                </div>
            </figure>
            <div class="product-details">
                
                <h3 class="product-name text-center">
                    <a href="{{ route('home.product',['alias'=>$product->alias]) }}">{{ $product->name }}</a>
                </h3>
                {{--        <div class="text-center d-flex justify-content-center"--}}
                {{--             data-rating-stars="5"--}}
                {{--             data-rating-readonly="true"--}}
                {{--             data-rating-value="{{ ceil($product->rates->where('product_id',$product->id)->avg('rate')) }}">--}}
                {{--        </div>--}}
              @if($product->sale_price == 0 or $product->quantity == 0)
                    <div class="product-over h-price">
                <span class="p-2 text-center quantity-finished-text">
                    اتمام موجودی
                </span>
                    </div>
                @else
                    @if(product_price_for_user_normal($product->id)[2]==0)
                        <div class="product-over h-price">
                <span class="p-2 text-center quantity-finished-text">
                    اتمام موجودی
                </span>
                        </div>
                    @else
                    
                            <div class="h-price products_old_price d-flex justify-content-center align-items-center">
                                   
                                                                    <span>
                                                                         @if(product_price_for_user_normal($product->id)[1]!=0)
                                                                         <del>
                                                                        {{ number_format(product_price_for_user_normal($product->id)[0]) }}
                                                                        </del>
                                                                        تومان
                                                                              @endif
                                                                     </span>
                                                                 
                            </div>
                      
                        <div class="product-pa-wrapper h-price">
                            <div class="product-price">
                                {{ number_format(product_price_for_user_normal($product->id)[2]) }}
                                تومان
                            </div>
                        </div>
                    @endif
                @endif

                  
             
            </div>
        </div>
    </div>
@endforeach
