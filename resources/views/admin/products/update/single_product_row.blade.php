@foreach ($products as $key => $product)
    <tr>
        @if($products->has('firstItem'))
            <th>
                {{ $products->firstItem() + $key }}
            </th>
        @else
            <th>
                {{ $key+1 }}
            </th>
        @endif
        <th class="position-relative">
            <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}">
                {{ $product->name }}
            </a>
        </th>
        @php
            $categories = $product->Categories;

    $category_name = '';
    foreach ($categories as $category) {

        $category_name = $category->name . '/' . $category_name;
        }

    $product_category_name = $category_name;


        @endphp

        <th>
            {{$product_category_name}}
        </th>
        @php
            if ($product->Brands == null) {
 $brand = '-';
} else {
 $brand_name = '';
 $brands = $product->Brands;
 foreach ($brands as $brand) {

     $brand_name = $brand->name . '/' . $brand_name;
 }

 $product_brand_name = $brand_name;
}
        @endphp
        <th>
            {{ $product_brand_name }}
        </th>
        <th>
            <img class="img-thumbnail"
                 src="{{ imageExist(env('PRODUCT_IMAGES_UPLOAD_PATH'),$product->primary_image) }}">
        </th>
        <th>
            <input onchange="update_single_product_quantity({{ $product->id }},this)"
                   class="form-control form-control-sm" value="{{ $product->quantity }}">
        </th>
        <th>
            <input id="update_single_price_{{ $product->id }}"
                   onchange="update_single_price({{ $product->id }},this)"
                   class="form-control form-control-sm"
                   value="{{ number_format($product->price) }}">
        </th>
        <th>
            <input id="update_sale_price_{{ $product->id }}"
                   onchange="update_sale_price({{ $product->id }},this)"
                   class="form-control form-control-sm"
                   value="{{ number_format($product->sale_price) }}">
        </th>
        <th>
            <input id="update_percent_sale_price_{{ $product->id }}"
                   onchange="update_percent_sale_price({{ $product->id }},this)"
                   class="form-control form-control-sm"
                   value="{{ $product->percent_sale_price }}">
        </th>
        <th>
            <input
                {{ $product->has_discount==1 ? 'checked' : '' }} onchange="updateActiveDiscount({{ $product->id }})"
                type="checkbox" name="has_discount" id="has_discount">
        </th>
         <th>
          <a title="فروش ویژه" id="specialSale_icon_{{ $product->id }}"
                                   onclick="specialSale({{ $product->id }})"
                                   class="btn btn-sm {{ $product->getRawOriginal('specialSale')==1 ? 'btn-success text-white' : 'btn-dark' }}">
                                    {{ $product->specialSale }}
           </a>                      
         </th>
    </tr>
@endforeach
