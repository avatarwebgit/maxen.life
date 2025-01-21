
  @foreach($products as $product)

                            <div class="col-lg-3 mb-4">
                                <div  class="card">
                                    <a href="{{ route('home.product',['alias'=>$product->alias]) }}">
                                    <img class="card-img-top" src="{{ imageExist(env('PRODUCT_IMAGES_UPLOAD_PATH'),$product->primary_image) }}">

                                    </a>
                                    <div class="card-body">
                                        <div class="product-title">
                                            <p>{{$product->title_1}} <b> {{$product->title_2}}</b></p>
                                            <p>{{app()->getLocale() == 'fa' ? $product->name : $product->name_en}}</p>
                                        </div>
                                        <div class="product-details">

                               @if($product->shortDescription != null)
                                            <div class="product-description">
                                                             <span>{{__('Attribute')}}</span>
                                                {!! $product->shortDescription !!}
                                            </div>
@endif
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                      <div class="d-block mb-4">

                                            <a onclick="AddToCompareList(event,{{ $product->id }},this)" class="btn-compare {{in_array($product->id,session()->get('compareProducts')) ? 'disabled': ''}} cursor-pointer">
                                           {{__('Add To CompareList')}}
                                        </a>
                                      </div>

                                        @foreach($product->attributes->reverse() as $item)

@if($item->attribute_id == 2 or $item->attribute_id == 46)
@if($item->attributeValues($item->value,$item->attribute_id)->image != null)
<img  class="product-brand" src="{{imageExist(env('ATTR_UPLOAD_PATH'),$item->attributeValues($item->value,$item->attribute_id)->image)}}">
@endif
@endif
@endforeach





                                    </div>

                                </div>
                            </div>
                            @endforeach
