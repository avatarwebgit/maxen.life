
  @foreach($products as $product)

      <div class="col-lg-4 col-sm-6 col-xl-4 col-xxl-3 col-md-4 mb-4">
          <div  class="card">
              <a href="{{ route('home.product',['alias'=>$product->alias]) }}">
                  <img class="card-img-top" src="{{ imageExist(env('PRODUCT_IMAGES_UPLOAD_PATH'),$product->primary_image) }}">

              </a>
              <div class="card-body">
                  <div class="product-title">
                      <p>{{app()->getLocale() == 'fa' ? $product->name : $product->name_en}}

                      </p>
                      <p>

                          <b>{{app()->getLocale() == 'fa' ? $product->title_1 : $product->title_1_en}} </b>
                      </p>
                      <p>{{app()->getLocale() == 'fa' ? $product->title_2 : $product->title_2_en}}</p>
                  </div>
                  <div class="product-details">

                      @if($product->shortDescription != null)
                          <div class="product-description">
                              <span class="product-custom-title">{{__('Attribute')}}</span>
                              {!! app()->getLocale() == 'fa' ? $product->shortDescription : $product->shortDescription_en !!}
                          </div>
                      @endif
                  </div>
              </div>
              <div class="card-footer">
                  <div class="d-flex mb-4 justify-content-center">

                      <a onclick="AddToCompareList(event,{{ $product->id }},this)" class="btn-compare mr-3  {{session()->get('compareProducts') ? (in_array($product->id,session()->get('compareProducts')??[]) ? 'disabled': '') : ''}}  cursor-pointer">
                          {{__('Compare')}}
                      </a>


                      <a href="{{ route('home.product',['alias'=>$product->alias]) }}" class="show-product cursor-pointer">{{__('More Information')}}</a>
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
