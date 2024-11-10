<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeGroup;
use App\Models\AttributeValues;
use App\Models\Brand;
use App\Models\Category;
use App\Models\FunctionalTypes;
use App\Models\InformMe;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttrVariation;
use App\Models\ProductColorVariation;
use App\Models\ProductImage;
use App\Models\ProductOption;
use App\Models\ProductVariation;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Collection;

class ProductController extends Controller
{
    public function product($alias)
    {
        $product = Product::where('alias', $alias)->firstOrFail();
        $AllProductImages = [];

        //get product gallery
        $productImages = ProductImage::where('product_id', $product->id)->get();
        $product_image_2 = null;
        foreach ($productImages as $productImage) {
            if ($productImage->set_as_second_image != 1) {
                array_push($AllProductImages, $productImage->image);
            } else {
                $product_image_2 = $productImage->image;
            }
        }
        $product_attr_Variation_Images = ProductColorVariation::where('product_id', $product->id)->get();
        $related_product_ids = [];
        $hit = $product->hit;
        $product->update([
            'hit' => $hit + 1
        ]);
        $product_attributes_original = ProductAttribute::where('product_id', $product->id)->where('is_active', 1)->orderby('priority', 'ASC')->get();
                $product_options = ProductOption::where('product_id', $product->id)->orderby('priority', 'ASC')->get();
                $product_attributes = ProductAttribute::where('product_id', $product->id)->orderby('priority', 'ASC')->get();
        //get attribute group ids
        $attribute_Group_ids = [];
        $attribute_without_group = [];

        foreach ($product_attributes as $product_attribute) {
            if ($product_attribute->attribute->group_id != null) {
                array_push($attribute_Group_ids, $product_attribute->attribute->group_id);
            } else {
                array_push($attribute_without_group, $product_attribute);
            }
        }
        $attribute_Group_ids = array_unique($attribute_Group_ids);
        $attribute_Groups = AttributeGroup::wherein('id', $attribute_Group_ids)->get();
        if (!$product->relatedProducts == null) {
            $related_product_ids = explode(',', $product->relatedProducts);
        }
        $related_products = Product::whereIn('id', $related_product_ids)->where('is_active', 1)->get();
        $attribute_ids = [];
        $attributes = Attribute::whereIn('id', $attribute_ids)->get();
        $product_options = ProductOption::where('product_id', $product->id)->orderby('price', 'ASC')->get();
        $product_options_attributes = [];
        foreach ($product_options as $product_option) {
            $attr = $product_option->attribute_id;
            array_push($product_options_attributes, $attr);
        }
        $product_options_attributes = array_unique($product_options_attributes);
        //set periority for show
        $result_product_options_attributes=\App\Models\Attribute::whereIn('id',$product_options_attributes)->orderBy('priority')->get('id');
        $product_options_attributes=[];
         foreach ($result_product_options_attributes as $result_product_options_attribute) {
             $product_options_attributes[]=$result_product_options_attribute->id;
         }
         //end set priority for show
        //محصولات دارای وابستگی رنگ
        $product_colors = ProductColorVariation::where('product_id', $product->id)->get();
        $product_attr_variations_categories = ProductAttrVariation::where('product_id', $product->id)->distinct()->get('attr_value');
        //product category name
        $categories = $product->Categories;
        $category_id = $categories[0]->id;
        $category = Category::find($category_id);
        $previous_product = $category->Products()->where('id', '!=', $product->id)->where('is_active', 1)->inRandomOrder()->first();
        if ($previous_product != null) {
            $next_product = $category->Products()->where('id', '!=', $product->id)->where('is_active', 1)->where('id', '!=', $previous_product->id)->inRandomOrder()->first();
        } else {
            $next_product = null;
        }
        $offerBrands = $product->OfferBrands;
        $offerCategories = $product->OfferCategories()->orderby('priority','asc')->get();
        $is_sale = true;
        foreach ($categories as $category) {
            if ($category->is_sale == 0) {
                $is_sale = false;
            }
        }
        return view('home.product', compact('product',
            'AllProductImages',
            'product_attributes_original',
            'product_attributes',
            'related_products',
            'attributes',
            'product_image_2',
            'product_options',
            'previous_product',
            'next_product',
            'product_options_attributes',
            'product_colors',
            'product_attr_variations_categories',
            'product_attr_Variation_Images',
            'attribute_Groups',
            'attribute_without_group',
            'offerBrands',
            'offerCategories',
            'is_sale'
        ));
    }

    //get product colors via ajax
    public function getProductColors(Request $request)
    {
        $products = ProductAttrVariation::where('product_id', $request->product_id)
            ->where('attr_value', $request->attr_value)
            ->get();
        $array = [];
        foreach ($products as $product) {
            $array[$product->color_attr_value] = $product->quantity;
        }
        $price_box = false;
        $quantity = false;
        if ($request->color_id != '') {
            //get price
            $product_variation = ProductAttrVariation::where('product_id', $request->product_id)
                ->where('attr_value', $request->attr_value)
                ->where('color_attr_value', $request->color_id)
                ->first();
            $quantity = '<p class="regular-price oldPrice">
                                    <span>تعداد موجود در انبار :<span id="span_quantity">' . $product_variation->quantity . '</span> عدد </span>
                                </p>';
            $has_discount = '';
            if (product_price_for_user_normal($request->product_id, $product_variation->id)[1] != 0) {
                $has_discount = '<p class="regular-price oldPrice">
                                            <span>قیمت :<del class="previous_product_price_span">' . number_format(product_price_for_user_normal($request->product_id, $product_variation->id)[0]) . '</del> تومان</span>
                                            <input class="previous_product_price" type="hidden" value="' . product_price_for_user_normal($request->product_id, $product_variation->id)[0] . '">
                                        </p>';
            }
            $price_box = '<div class="single-product-price">' . $has_discount . '
                                    <div class="btn btn-block btn-primary">
                                        <p class="price new-price">
                                            <span>قیمت :<span class="product_final_price_span">' . number_format(product_price_for_user_normal($request->product_id, $product_variation->id)[2]) . '</span> تومان</span>
                                            <input class="product_final_price" type="hidden" value="' . product_price_for_user_normal($request->product_id, $product_variation->id)[2] . '">
                                        </p>
                                        <input type="hidden" id="" value="">
                                    </div>
                                </div>';
        }
        return response()->json([1, $array, $price_box, $quantity]);
    }

    //get product attribute via ajax
    public function getAttributeVariation(Request $request)
    {
        $products = ProductAttrVariation::where('product_id', $request->product_id)
            ->where('color_attr_value', $request->color_id)
            ->get();
        $array = [];
        foreach ($products as $product) {
            $array[$product->attr_value] = $product->quantity;
        }
        $price_box = false;
        $quantity = false;
        if ($request->attr_value != '') {
            //get price
            $product_variation = ProductAttrVariation::where('product_id', $request->product_id)
                ->where('attr_value', $request->attr_value)
                ->where('color_attr_value', $request->color_id)
                ->first();
            $quantity = '<p class="regular-price oldPrice">
                                    <span>تعداد موجود در انبار :<span id="span_quantity">' . $product_variation->quantity . '</span> عدد </span>
                                </p>';
            $has_discount = '';
            if (product_price_for_user_normal($request->product_id, $product_variation->id)[1] != 0) {
                $has_discount = '<p class="regular-price oldPrice">
                                            <span>قیمت :<del class="previous_product_price_span">' . number_format(product_price_for_user_normal($request->product_id, $product_variation->id)[0]) . '</del> تومان</span>
                                            <input class="previous_product_price" type="hidden" value="' . product_price_for_user_normal($request->product_id, $product_variation->id)[0] . '">
                                        </p>';
            }
            $price_box = '<div class="single-product-price">' . $has_discount . '
                                    <div class="btn btn-block btn-primary">
                                        <p class="price new-price">
                                            <span>قیمت :<span class="product_final_price_span">' . number_format(product_price_for_user_normal($request->product_id, $product_variation->id)[2]) . '</span> تومان</span>
                                            <input class="product_final_price" type="hidden" value="' . product_price_for_user_normal($request->product_id, $product_variation->id)[2] . '">
                                        </p>
                                        <input type="hidden" id="" value="">
                                    </div>
                           </div>';
        }
        //get color images
        $ProductColorVariation = ProductColorVariation::where('product_id', $request->product_id)->where('attr_value', $request->color_id)->first();
        $image = $ProductColorVariation->image;
        if ($image != null) {
            $image_src = imageExist(env('PRODUCT_VARIATION_COLOR_UPLOAD_PATH'), $image);
        } else {
            $image_src = null;
        }

        return response()->json([1, $array, $price_box, $quantity, $image_src]);
    }

    //get All product variation via ajax
    public function getAllProductVariations(Request $request)
    {
        $product_id = $request->product_id;
        $productAttrVariations = ProductAttrVariation::where('product_id', $product_id)->distinct()->get('attr_value');
        $rows = '';
        foreach ($productAttrVariations as $item) {
            $rows = $rows . '<label
                  for="product_attr_variation_categories_' . $item->AttributeValue->id . '"><span class="product_color colors">
            <input onclick="getProductColors(' . $item->attr_value . ',' . $product_id . ',this)" type="radio" name="product_attr_variation_categories" id="product_attr_variation_categories_' . $item->attr_value . '"
               value="' . $item->attr_value . '">

                  ' . $item->AttributeValue->name . '
            </span>
            </label>';
        }
        return response()->json([1, $rows]);
    }

    //get All product colors via ajax
    public function getAllProductColors(Request $request)
    {
        $product_id = $request->product_id;
        $product_colors = ProductColorVariation::where('product_id', $product_id)->get();
        $rows = '';
        foreach ($product_colors as $product_color) {
            $rows = $rows . '<label
                for="product_color_' . $product_color->Color->id . '"><span class="product_color variations">
            <img class="img-variations" src="' . imageExist(env('ATTR_UPLOAD_PATH'), $product_color->Color->image) . '">
             <input onclick="getAttributeVariation(' . $product_color->Color->id . ',' . $product_id . ',this)" type="radio" name="product_color"
              id="product_color_' . $product_color->Color->id . '" value="' . $product_color->Color->id . '">
              ' . $product_color->Color->name . '
               </span>
               </label>';
        }
        return response()->json([1, $rows]);
    }

    public function product_categories(Category $category, Request $request)
    {
        //get all items for filter
        $brands = Brand::all();
        $limit = 12;
        $categories = Category::all();
        $default_sort = 0;
        $param = 'priority_show';
        $sort_param = 'ASC';
        $products = $category->Products()->where('is_active', 1)->get();
        $product_ids = [];
        foreach ($products as $product) {
            $product_ids[] = $product->id;
        }
        if ($request->ajax()) {
            $attribute_values = [];
            if ($request->has('attribute_values')) {
                $attribute_values = $request['attribute_values'];
            }
            $product_attribute_ids = [];
            $product_attributes = ProductAttribute::whereIn('value', $attribute_values)->get()->groupBy('attribute_id');
            $attribute_group_count = count($product_attributes);
            foreach ($product_attributes as $product_attribute) {
                foreach ($product_attribute as $item) {
                    $product_attribute_ids[] = $item->product_id;
                }
            }
            $product_ids = [];
            $array_count_values_attribute_ids = array_count_values($product_attribute_ids);
            foreach ($array_count_values_attribute_ids as $key => $array_count_values_attribute_id) {
                if ($attribute_group_count == $array_count_values_attribute_id) {
                    $product_ids[] = $key;
                }
            }
            $all_products = Product::whereIn('id', $product_ids)->where('is_active', 1)->get();
            $filter_product_ids = [];
            foreach ($all_products as $all_product) {
                $filter_product_ids[] = $all_product->id;
            }

            $page = $request->page;

            $limit = $page * $limit;

            $all_products = $category->Products()->
            when($request->has('attribute_values'), function ($query) use ($filter_product_ids) {
                return $query->whereIn('id', $filter_product_ids);
            })->where('is_active', 1)

                ->paginate($limit);

            $products = $category->Products()->when($request->has('attribute_values'), function ($query) use ($filter_product_ids) {
                return $query->whereIn('id', $filter_product_ids);
            })->where('is_active', 1)
                ->skip(0)
                ->take($limit)

                ->get();


            $last_page = $all_products->lastPage();
            $view = view('home.sections.product_box', compact('products'))->render();
            return response()->json([1, $view, $last_page]);
        }

        $filter_brands_selected = $_GET['brand_ids'] ?? [];
        $filter_color_selected = $_GET['color_ids'] ?? [];
        $filter_model_selected = $_GET['model_ids'] ?? [];
        $setting = Setting::first();
        $sort = $_GET['orderby'] ?? $setting->product_sort;

        //get related categories
        $related_categories = Category::where('parent_id', $category->id)->get();
        if (count($related_categories) == 0) {
            $related_categories = Category::where('parent_id', $category->parent_id)->get();
        }
        foreach ($related_categories as $related_category) {
            $product_count = $related_category->Products()->where('is_active', 1)->get();
            $related_category['product_count'] = count($product_count);
        }
        $expensive_p = Product::whereIn('id', $product_ids)->where('is_active', 1)->orderby('price', 'desc')->first();
        if ($expensive_p != null) {
            $expensive_product = $expensive_p->price;
        } else {
            $expensive_product = 0;
        }
        $cheapest_p = Product::whereIn('id', $product_ids)->where('is_active', 1)->orderby('price', 'asc')->first();
        if ($cheapest_p != null) {
            $cheapest_product = $cheapest_p->price;
        } else {
            $cheapest_product = 0;
        }
        $min_price = $cheapest_product;
        $max_price = $expensive_product;
        $all_products = Product::whereIn('id', $product_ids)->where('is_active', 1)->get();
        $all_attribute_exists_ids = [];
        $all_attribute_value_exists_ids = [];
        foreach ($all_products as $item) {
            $attrs = $item->attributes;
            $product_variations = $item->ProductAttributeVariation($item->id);
            $product_options = $item->options;
            foreach ($attrs as $attr) {
                array_push($all_attribute_exists_ids, $attr->attribute_id);
                array_push($all_attribute_value_exists_ids, $attr->value);
                array_push($all_attribute_value_exists_ids, $attr->attr_value);
                array_push($all_attribute_value_exists_ids, $attr->color_attr_value);
            }
            foreach ($product_options as $product_option) {
                array_push($all_attribute_exists_ids, $product_option->attribute_id);

            }
            foreach ($product_variations as $product_variation) {
                array_push($all_attribute_exists_ids, $product_variation->attr_id);

            }
        }
        $all_attribute_exists_ids = array_unique($all_attribute_exists_ids);
        $all_attribute_value_exists_ids = array_unique($all_attribute_value_exists_ids);
        $attributes = Attribute::where('is_filter', 1)->whereIn('id', $all_attribute_exists_ids)->orderby('priority', 'asc')->get();
        $products = Product::whereIn('id', $product_ids)->where('is_active', 1)->orderby($param, $sort_param)->paginate($limit);
        $product_new = [];

        foreach ($products as $key => $item) {
            if ($item->quantity == 0 or $item->price == 0) {
                $product_new[] = $item->id;
                $products->forget($key);
            }
        };
        $products_missing = Product::whereIn('id', $product_new)->orderBy('name','asc')->get();


        foreach ($products_missing as $item) {

            $products->push($item);
        }
        $products_count = count($products);
  


        return view('home.products_category',
            compact(
                'default_sort',
                'category',
                'brands',
                'products',
                'related_categories',
                'cheapest_product',
                'expensive_product',
                'filter_brands_selected',
                'min_price',
                'max_price',
                'sort',
                'filter_color_selected',
                'filter_model_selected',
                'products_count',
                'categories',
                'attributes',
                'all_attribute_value_exists_ids',
            ));
    }

    public function has_discount_products()
    {
        $products = Product::where('is_active', 1)
            ->where('percentSalePrice', '>', 0)
            ->where('DateOnSaleFrom', '<', Carbon::now())
            ->where('DateOnSaleTo', '>', Carbon::now())
            ->orwhere('has_discount', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(40);

        $products_count = Product::where('is_active', 1)
            ->where('percentSalePrice', '>', 0)
            ->where('DateOnSaleFrom', '<', Carbon::now())
            ->where('DateOnSaleTo', '>', Carbon::now())
            ->orwhere('has_discount', 1)
            ->orderBy('created_at', 'DESC')
            ->count();
        return view('home.has_discount_products', compact('products', 'products_count'));
    }

    //other products page
    public function products_new(Request $request)
    {
        $limit = 12;
        $products = Product::where('is_active', 1)
            ->where('Set_as_new', 1)
                    ->where('quantity','>',0)
            ->orderby('created_at', 'DESC')
            ->paginate($limit);

        $products_count = Product::where('is_active', 1)
            ->where('Set_as_new', 1)
            ->count();
        $setting = Setting::first();
        if ($request->ajax()) {


            $product_id_attr = [];

            foreach ($products as $product) {

                $product_id_attr[] = $product->id;

            }
            $product_id_attr = array_unique($product_id_attr);
            $page = $request->page;

            $limit = $page * $limit;

            $all_products = Product::whereIn('id', $product_id_attr)
                ->where('is_active', 1)
                        ->where('quantity',1)
                ->where('Set_as_new', 1)
                ->orderby('created_at', 'DESC')
                ->paginate($limit);

            $products = Product::whereIn('id', $product_id_attr)
                ->where('is_active', 1)
                ->where('Set_as_new', 1)
                ->orderby('created_at', 'DESC')
                ->skip(0)
                ->take($limit)
                ->get();


            $products_count = count($products);
            $last_page = $all_products->lastPage();
            $col = 'col-lg-3 col-md-6';
            $view = view('home.sections.product_box', compact('products', 'col'))->render();
            return response()->json([1, $view, $last_page]);
        }


        return view('home.products_new', compact('products', 'products_count', 'setting'));

    }

    public function products_special(Request $request)
    {
        $limit = 12;
        $products = Product::where('is_active', 1)
            ->where('specialSale', 1)
        ->where('quantity','>',0)
            ->orderby('name', 'ASC')
            ->paginate($limit);
        $products_count = Product::where('is_active', 1)
            ->where('specialSale', 1)
            ->count();
        $setting = Setting::first();
        if ($request->ajax()) {


            $product_id_attr = [];

            foreach ($products as $product) {

                $product_id_attr[] = $product->id;

            }
            $product_id_attr = array_unique($product_id_attr);
            $page = $request->page;

            $limit = $page * $limit;

            $all_products = Product::whereIn('id', $product_id_attr)
                ->where('is_active', 1)
                        ->where('quantity',1)
                ->where('specialSale', 1)
                ->orderby('name', 'ASC')
                ->paginate($limit);

            $products = Product::whereIn('id', $product_id_attr)
                ->where('is_active', 1)
                ->where('specialSale', 1)
                ->orderby('name', 'ASC')
                ->skip(0)
                ->take($limit)
                ->get();


            $products_count = count($products);
            $last_page = $all_products->lastPage();
            $col = 'col-lg-3 col-md-6';
            $view = view('home.sections.product_box', compact('products', 'col'))->render();
            return response()->json([1, $view, $last_page]);
        }
        return view('home.products_special', compact('products', 'products_count', 'setting'));

    }

    public function products_discount(Request $request)
    {
        $limit = 12;
        $products = Product::where('is_active', 1)->where('DateOnSaleTo', '>', Carbon::now())->where('DateOnSaleFrom', '<', Carbon::now())
            ->orwhere('has_discount', 1)
            ->orderby('name', 'ASC')
            ->latest()
            ->paginate($limit);
        $products_count = Product::where('is_active', 1)->where('DateOnSaleTo', '>', Carbon::now())->where('DateOnSaleFrom', '<', Carbon::now())
            ->orwhere('has_discount', 1)
            ->latest()
            ->count();
        if ($request->ajax()) {
            $product_id_attr = [];
            foreach ($products as $product) {
                $product_id_attr[] = $product->id;
            }
            $product_id_attr = array_unique($product_id_attr);
            $page = $request->page;
            $limit = $page * $limit;
            $all_products = Product::whereIn('id', $product_id_attr)
                ->where('is_active', 1)
                ->where('DateOnSaleTo', '>', Carbon::now())->where('DateOnSaleFrom', '<', Carbon::now())
                ->orwhere('has_discount', 1)
                ->latest()
                ->paginate($limit);

            $products = Product::whereIn('id', $product_id_attr)
                ->where('is_active', 1)
                ->where('DateOnSaleTo', '>', Carbon::now())
                ->where('DateOnSaleFrom', '<', Carbon::now())
                ->orwhere('has_discount', 1)
                ->orderby('name', 'ASC')
                ->skip(12)
                ->take($limit)
                ->get();





            $products_count = count($products);
            $last_page = $all_products->lastPage();
            $col = 'col-lg-3 col-md-6';
            $view = view('home.sections.product_box', compact('products', 'col'))->render();
            return response()->json([1, $view, $last_page]);
        }

        return view('home.products_discount', compact('products', 'products_count'));

    }

    public function products_brand(Brand $brand, Request $request)
    {
        //get all items for filter
        $brands = Brand::all();
        $limit = 12;
        $categories = Category::all();
        $default_sort = 0;
        $param = 'name';
        $sort_param = 'asc';
        $products = $brand->Products()->where('is_active', 1)->get();
        $product_ids = [];
        foreach ($products as $product) {
            $product_ids[] = $product->id;
        }
        if ($request->ajax()) {
            $attribute_values = [];
            if ($request->has('attribute_values')) {
                $attribute_values = $request['attribute_values'];
            }
            $product_attribute_ids = [];
            $product_attributes = ProductAttribute::whereIn('value', $attribute_values)->get()->groupBy('attribute_id');
            $attribute_group_count = count($product_attributes);
            foreach ($product_attributes as $product_attribute) {
                foreach ($product_attribute as $item) {
                    $product_attribute_ids[] = $item->product_id;
                }
            }
            $product_ids = [];
            $array_count_values_attribute_ids = array_count_values($product_attribute_ids);
            foreach ($array_count_values_attribute_ids as $key => $array_count_values_attribute_id) {
                if ($attribute_group_count == $array_count_values_attribute_id) {
                    $product_ids[] = $key;
                }
            }
            $all_products = Product::whereIn('id', $product_ids)->where('is_active', 1)->get();
            $filter_product_ids = [];
            foreach ($all_products as $all_product) {
                $filter_product_ids[] = $all_product->id;
            }

            $sort = $request['sort'];
            $price_amount = $request['price_amount'];
            $price_amount = explode('-', $price_amount);
            $max_price = $price_amount[0];
            $min_price = $price_amount[1];

            if ($sort == 1) {
                $param = 'id';
                $sort_param = 'desc';
            }
            if ($sort == 2) {
                $param = 'id';
                $sort_param = 'asc';
            }
            if ($sort == 3) {
                $param = 'price';
                $sort_param = 'desc';
            }
            if ($sort == 4) {
                $param = 'price';
                $sort_param = 'asc';
            }
            if ($sort == 5) {
                $param = 'hit';
                $sort_param = 'desc';
            }
            $page = $request->page;

            $limit = $page * $limit;

            $all_products = $brand->Products()->
            when($request->has('attribute_values'), function ($query) use ($filter_product_ids) {
                return $query->whereIn('id', $filter_product_ids);
            })->where('is_active', 1)
                ->where('price', '>=', $min_price)
                ->where('price', '<=', $max_price)
                ->orderby($param, $sort_param)
                ->paginate($limit);

            $products = $brand->Products()->when($request->has('attribute_values'), function ($query) use ($filter_product_ids) {
                return $query->whereIn('id', $filter_product_ids);
            })->where('is_active', 1)
                ->where('price', '>=', $min_price)
                ->where('price', '<=', $max_price)
                ->skip(0)
                ->take($limit)
                ->orderby($param, $sort_param)
                ->get();


            $product_new = [];

            foreach ($products as $key => $item) {
                if ($item->quantity == 0 or $item->price == 0) {
                    $product_new[] = $item->id;
                    $products->forget($key);
                }
            };
            $products_missing = Product::whereIn('id', $product_new)->orderBy('name','asc')->get();


            foreach ($products_missing as $item) {

                $products->push($item);
            }
            $products_count = count($products);
            $last_page = $all_products->lastPage();
            $view = view('home.sections.product_box', compact('products'))->render();
            return response()->json([1, $view, $last_page]);
        }

        $filter_brands_selected = $_GET['brand_ids'] ?? [];
        $filter_color_selected = $_GET['color_ids'] ?? [];
        $filter_model_selected = $_GET['model_ids'] ?? [];
        $setting = Setting::first();
        $sort = $_GET['orderby'] ?? $setting->product_sort;
        $expensive_p = Product::whereIn('id', $product_ids)->where('is_active', 1)->orderby('price', 'desc')->first();
        if ($expensive_p != null) {
            $expensive_product = $expensive_p->price;
        } else {
            $expensive_product = 0;
        }
        $cheapest_p = Product::whereIn('id', $product_ids)->where('is_active', 1)->orderby('price', 'asc')->first();
        if ($cheapest_p != null) {
            $cheapest_product = $cheapest_p->price;
        } else {
            $cheapest_product = 0;
        }
        $min_price = $cheapest_product;
        $max_price = $expensive_product;
        $all_products = Product::whereIn('id', $product_ids)->where('is_active', 1)->get();
        $all_attribute_exists_ids = [];
        $all_attribute_value_exists_ids = [];
        foreach ($all_products as $item) {
            $attrs = $item->attributes;
            $product_variations = $item->ProductAttributeVariation($item->id);
            $product_options = $item->options;
            foreach ($attrs as $attr) {
                array_push($all_attribute_exists_ids, $attr->attribute_id);
                array_push($all_attribute_value_exists_ids, $attr->value);
            }
            foreach ($product_options as $product_option) {
                array_push($all_attribute_exists_ids, $product_option->attribute_id);
                array_push($all_attribute_value_exists_ids, $attr->value);
            }
            foreach ($product_variations as $product_variation) {
                array_push($all_attribute_exists_ids, $product_variation->attr_id);
                array_push($all_attribute_value_exists_ids, $attr->attr_value);
                array_push($all_attribute_value_exists_ids, $attr->color_attr_value);
            }
        }
        $all_attribute_exists_ids = array_unique($all_attribute_exists_ids);
        $all_attribute_value_exists_ids = array_unique($all_attribute_value_exists_ids);
        $attributes = Attribute::where('is_filter', 1)->whereIn('id', $all_attribute_exists_ids)->orderby('priority', 'asc')->get();
        $products = Product::whereIn('id', $product_ids)->where('is_active', 1)->orderby($param, $sort_param)->paginate($limit);
        $product_new = [];

        foreach ($products as $key => $item) {
            if ($item->quantity == 0 or $item->price == 0) {
                $product_new[] = $item->id;
                $products->forget($key);
            }
        };
        $products_missing = Product::whereIn('id', $product_new)->orderBy('name','asc')->get();


        foreach ($products_missing as $item) {

            $products->push($item);
        }
        $products_count = count($products);


        return view('home.products_brand',
            compact(
                'default_sort',
                'brands',
                'brand',
                'products',
                'cheapest_product',
                'expensive_product',
                'filter_brands_selected',
                'min_price',
                'max_price',
                'sort',
                'filter_color_selected',
                'filter_model_selected',
                'products_count',
                'categories',
                'attributes',
                'all_attribute_value_exists_ids',
            ));
    }

    public function products_type(FunctionalTypes $type)
    {
        $products = $type->products()->where('is_active', 1)
            ->paginate(40);
        $products_count = $type->products()->where('is_active', 1)
            ->count();

        return view('home.products_types', compact('products', 'products_count', 'type'));

    }

    public function brands()
    {
        $brands = Brand::all();
        return view('home.brands', compact('brands'));

    }

    public function search(Request $request)
    {
        $title = $request->title;
        $brand = $request->brand;
        if ($brand == 0) {
            $products = Product::where('is_active', 1)->where(function ($query) use ($title) {
                $query->where('name', 'LIKE', '%' . $title . '%')
                    ->orWhere('similarWords', 'LIKE', '%' . $title . '%');
            })->orderby('name','asc')->get();
        } else {
            $products = Product::where('is_active', 1)->where('brand_id', $brand)->where(function ($query) use ($title) {
                $query->where('name', 'LIKE', '%' . $title . '%')
                    ->orWhere('similarWords', 'LIKE', '%' . $title . '%');
            })->orderby('name','asc')->get();
        }
        $html = '';
        foreach ($products as $product) {
            $html = $html . '<a href="' . route('home.product', ['alias' => $product->alias]) . '" class="d-flex justify-content-between align-items-center mt-2">
                                            <span>
                                                ' . $product->name . '
                                            </span>
                                            <img class="img-thumbnail" src="' . imageExist(env('PRODUCT_IMAGES_UPLOAD_PATH'), $product->primary_image) . '">
                                        </a>';
        }
        return response()->json([1, $html]);
    }
    public function convert2english($string) {
    $newNumbers = range(0, 9);
    // 1. Persian HTML decimal
    $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
    // 2. Arabic HTML decimal
    $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
    // 3. Arabic Numeric
    $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
    // 4. Persian Numeric
    $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

    $string =  str_replace($persianDecimal, $newNumbers, $string);
    $string =  str_replace($arabicDecimal, $newNumbers, $string);
    $string =  str_replace($arabic, $newNumbers, $string);
    return str_replace($persian, $newNumbers, $string);
}

  public function search_page(Request $request)
    {

        //get all items for filter
        $limit = 12;
        $title = $request->search;
        $categories = Category::all();
        $default_sort = 0;
        $param = 'quantity';
        $sort_param = 'desc';
        $brand_ids = [];
        $products = Product::where('is_active', 1)->where(function ($query) use ($title) {
            $query->where('name', 'LIKE', '%' . $title . '%')
                ->orWhere('similarWords', 'LIKE', '%' . $title . '%');
        })->orderBy('quantity', 'desc')->paginate(40);
        foreach ($products as $product) {
            $brand_ids[] = $product->brand_id;
        }
        $brand_ids = array_unique($brand_ids);
        $brands = Brand::whereIn('id', $brand_ids)->get();
        $product_ids = [];
        foreach ($products as $product) {
            $product_ids[] = $product->id;
        }
        if ($request->ajax()) {
            $attribute_values = [];
            if ($request->has('attribute_values')) {
                $attribute_values = $request['attribute_values'];
            }
            $brands = [];
            if ($request->has('brands')) {
                $brands = $request->brands;
            }
            $product_attribute_ids = [];
            $product_attributes = ProductAttribute::whereIn('value', $attribute_values)->get()->groupBy('attribute_id');
            $attribute_group_count = count($product_attributes);
            foreach ($product_attributes as $product_attribute) {
                foreach ($product_attribute as $item) {
                    $product_attribute_ids[] = $item->product_id;
                }
            }
            $product_ids = [];
            $array_count_values_attribute_ids = array_count_values($product_attribute_ids);
            foreach ($array_count_values_attribute_ids as $key => $array_count_values_attribute_id) {
                if ($attribute_group_count == $array_count_values_attribute_id) {
                    $product_ids[] = $key;
                }
            }
            $all_products = Product::whereIn('id', $product_ids)->where('is_active', 1)->get();
            $filter_product_ids = [];
            foreach ($all_products as $all_product) {
                $filter_product_ids[] = $all_product->id;
            }
            $sort = $request['sort'];
            $max_price = $request['max_price'];
            $min_price = $request['min_price'];
            if ($sort == 1) {
                $param = 'id';
                $sort_param = 'desc';
            }
            if ($sort == 2) {
                $param = 'id';
                $sort_param = 'asc';
            }
            if ($sort == 3) {
                $param = 'price';
                $sort_param = 'desc';
            }
            if ($sort == 4) {
                $param = 'price';
                $sort_param = 'asc';
            }
            if ($sort == 5) {
                $param = 'hit';
                $sort_param = 'desc';
            }
            $page = $request->page;

            $limit = $page * $limit;
            $products = Product::where('is_active', 1)->where(function ($query) use ($title) {
                $query->where('name', 'LIKE', '%' . $title . '%')
                    ->orWhere('similarWords', 'LIKE', '%' . $title . '%');
            })->when($request->has('attribute_values'), function ($query) use ($filter_product_ids) {
                return $query->whereIn('id', $filter_product_ids);
            })->where('is_active', 1)
                ->when($min_price != null, function ($query) use ($min_price) {
                    return $query->where('price', '>=', $min_price);
                })
                ->when($max_price != null, function ($query) use ($max_price) {
                    return $query->where('price', '<=', $max_price);
                })
                ->when($request->has('brands'), function ($query) use ($brands) {
                    return $query->whereIn('brand_id', $brands);
                })
                ->when($request->has('has_quantity'), function ($query) {
                    return $query->where('quantity', '>', 0);
                })
                ->skip(0)
                ->take($limit)
                ->orderby($param, $sort_param)
                ->get();
            $product_new = [];

            foreach ($products as $key => $item) {
                if ($item->quantity == 0 or $item->price == 0) {
                    $product_new[] = $item->id;
                    $products->forget($key);
                }
            };
            $products_missing = Product::whereIn('id', $product_new)->get();
            foreach ($products_missing as $item) {
                $products->push($item);
            }
            $cat = 'col-xl-4 col-md-6 col-sm-6';
            $view = view('home.sections.product_box_2', compact('products', 'cat'))->render();
            return response()->json([1, $view]);
        }

        $filter_brands_selected = $_GET['brand_ids'] ?? [];
        $filter_color_selected = $_GET['color_ids'] ?? [];
        $filter_model_selected = $_GET['model_ids'] ?? [];
        $setting = Setting::first();
        $sort = $_GET['orderby'] ?? $setting->product_sort;


        $expensive_p = Product::whereIn('id', $product_ids)->where('is_active', 1)->orderby('price', 'desc')->first();
        if ($expensive_p != null) {
            $expensive_product = $expensive_p->price;
        } else {
            $expensive_product = 0;
        }
        $cheapest_p = Product::whereIn('id', $product_ids)->where('is_active', 1)->orderby('price', 'asc')->first();
        if ($cheapest_p != null) {
            $cheapest_product = $cheapest_p->price;
        } else {
            $cheapest_product = 0;
        }
        $min_price = $cheapest_product;
        $max_price = $expensive_product;
        $all_products = Product::whereIn('id', $product_ids)->where('is_active', 1)->get();
        $all_attribute_exists_ids = [];
        $all_attribute_value_exists_ids = [];
        foreach ($all_products as $item) {
            $attrs = $item->attributes;
            $product_variations = $item->ProductAttributeVariation($item->id);
            $product_options = $item->options;
            if (count($attrs) > 0) {
                foreach ($attrs as $attr) {
                    array_push($all_attribute_exists_ids, $attr->attribute_id);
                    array_push($all_attribute_value_exists_ids, $attr->value);
                }
            }

            if (count($product_options) > 0) {
                foreach ($product_options as $product_option) {
                    array_push($all_attribute_exists_ids, $product_option->attribute_id);
                    array_push($all_attribute_value_exists_ids, $attr->value);
                }
            }
            if (count($product_variations) > 0) {
                foreach ($product_variations as $product_variation) {
                    array_push($all_attribute_exists_ids, $product_variation->attr_id);
                    array_push($all_attribute_value_exists_ids, $attr->attr_value);
                    array_push($all_attribute_value_exists_ids, $attr->color_attr_value);
                }
            }
        }
        $all_attribute_exists_ids = array_unique($all_attribute_exists_ids);
        $all_attribute_value_exists_ids = array_unique($all_attribute_value_exists_ids);
        $attributes = Attribute::where('is_filter', 1)->whereIn('id', $all_attribute_exists_ids)->orderby('priority', 'asc')->get();
        $products = Product::whereIn('id', $product_ids)->where('is_active', 1)->orderby($param, $sort_param)->paginate($limit);

        $product_new = [];
        foreach ($products as $key => $item) {
            if ($item->quantity == 0 or $item->price == 0) {
                $product_new[] = $item->id;
                $products->forget($key);
            }
        };
        $products_missing = Product::whereIn('id', $product_new)->get();
        foreach ($products_missing as $item) {
            $products->push($item);
        }
        $products_count = count($products);
        return view('home.products_search',
            compact(
                'default_sort',
                'title',

                'brands',
                'products',

                'cheapest_product',
                'expensive_product',
                'filter_brands_selected',
                'min_price',
                'max_price',
                'sort',
                'filter_color_selected',
                'filter_model_selected',
                'products_count',
                'categories',
                'attributes',
                'all_attribute_value_exists_ids'
            ));
    }

    public function informMe(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([0, 'login']);
        }
        $user_id = auth()->id();
        $check_product_exist = InformMe::where('user_id', $user_id)->where('product_id', $request->product_id)->exists();
        if ($check_product_exist) {
            return response()->json([0, 'exists']);
        }
        InformMe::create([
            'user_id' => $user_id,
            'product_id' => $request->product_id,
        ]);
        return response()->json([1, 'ok']);
    }

    public function torob()
    {
        $product_json = [];
        $products = Product::where('is_active', 1)->latest()->get();
        $i = 0;
        foreach ($products as $product) {
            $i = $i + 1;
            $product['product_id'] = $product->id;
            if ($product->quantity == 0) {
                $availability = '';
            } else {
                $availability = 'instock';
            }
            if ($product->Categories()->count() > 0) {
                foreach ($product->Categories as $category) {
                    if ($category->is_sale == 0) {
                        $availability = '';
                    }
                }
            }

            $product['availability'] = $availability;
            $price = product_price_for_user_normal($product->id)[0];
            $percent_sale_price = product_price_for_user_normal($product->id)[1];
            $sale_price = product_price_for_user_normal($product->id)[2];
            if ($percent_sale_price == 0) {
                $product['price'] = $price;
                $product['old_price'] = 0;
            } else {
                $product['price'] = $sale_price;
                $product['old_price'] = $price;
            }
            $product['page_url'] = route('home.product', ['alias' => $product->alias]);
            $keys = [
                'name',
                'price',
                'product_id',
                'availability',
                'old_price',
                'page_url',
            ];
            $product = array_filter($product->toArray(), function ($k) use ($keys) {
                return in_array($k, $keys, true);
            }, ARRAY_FILTER_USE_KEY);
            $product['row_id'] = $i;
            $product['price'] = intval($product['price']);
            $product['old_price'] = intval($product['old_price']);
            $product_json[] = $product;
        }
        return response()->json($product_json);
    }

    public function emalls()
    {
        $product_json = [];
        $products = Product::where('is_active', 1)->latest()->get();
        $i = 0;
        foreach ($products as $product) {

            $i = $i + 1;
            $product['product_id'] = $product->id;
            if ($product->quantity == 0) {
                $availability = 'outofstock';
            } else {
                $availability = 'instock';
            }
            if ($product->Categories()->count() > 0) {


                foreach ($product->Categories as $category) {
                    if ($category->is_sale == 0) {

                        $availability = 'outofstock';
                    }
                }
            }

            $product['availability'] = $availability;
            $price = product_price_for_user_normal($product->id)[0];
            $percent_sale_price = product_price_for_user_normal($product->id)[1];
            $sale_price = product_price_for_user_normal($product->id)[2];
            if ($percent_sale_price == 0) {
                $product['price'] = $price;
                $product['old_price'] = 0;
            } else {
                $product['price'] = $sale_price;
                $product['old_price'] = $price;
            }
            $product['page_url'] = route('home.product', ['alias' => $product->alias]);
            $keys = [
                'name',
                'price',
                'product_id',
                'availability',
                'old_price',
                'page_url',
            ];
            $product = array_filter($product->toArray(), function ($k) use ($keys) {
                return in_array($k, $keys, true);
            }, ARRAY_FILTER_USE_KEY);
            $product['row_id'] = $i;
            $product['price'] = intval($product['price']);
            $product['old_price'] = intval($product['old_price']);
            $product_json[] = $product;
        }
        return response()->json($product_json);
    }
}
