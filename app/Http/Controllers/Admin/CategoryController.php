<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Attribute;
use App\Models\City;
use App\Models\CityGroup;
use App\Models\DeliveryMethod;
use App\Models\Measure;
use App\Models\PeykPrice;
use App\Models\Product;
use App\Models\ProductAttrVariation;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use PHPUnit\TextUI\XmlConfiguration\Group;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        
                    if ($request->has('page')) {
        $request->session()->put('current_page', $request->input('page'));
    }
        $categories = Category::where('parent_id', '!=', 13)->orderBy('priority','asc')->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $parentCategories = Category::where('parent_id', 0)->get();
        $measures = Measure::all();
        return view('admin.categories.create', compact('parentCategories', 'measures'));
    }

    public function store(Request $request)
    {
                $currentPage = $request->session()->get('current_page', 1);
        $category_already_exists = Category::where('name', $request->name)->where('parent_id', $request->parent_id)->exists();
        if ($category_already_exists) {
            return redirect()->back()->withErrors(['msg' => 'این دسته بندی از قبل ساخته شده است']);
        }
        $request->validate([
            'primary_image' => 'nullable|mimes:jpg,jpeg,png,svg',
            'banner_image' => 'nullable|mimes:jpg,jpeg,png,svg',
            'header_image' => 'nullable|mimes:jpg,jpeg,png,svg',
            'description' => 'nullable|string|max:60000',
            'alias' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:60000',
            'meta_description' => 'nullable|string|max:60000',
        ]);
        if ($request->alias != null) {
            $request->validate([
                'alias' => 'required|unique:categories,alias',
            ]);
            $alias = $request->alias;
            $alias = parent::aliasCreator($alias);
        } else {
            $alias = null;
        }
        try {
            DB::beginTransaction();
            if ($request->has('primary_image')) {
                $productImageController = new ProductImageController();
                $Image = $productImageController->categoryImageUpload($request->primary_image);
            } else {
                $Image = null;
            }
            if ($request->has('banner_image')) {
                $Banner_image = $productImageController->categoryImageUpload($request->banner_image);
            } else {
                $Banner_image = null;
            }
            if ($request->has('header_image')) {
                $header_image_image = $productImageController->categoryImageUpload($request->header_image);
            } else {
                $header_image_image = null;
            }
            if ($request->has('depends_on_quantity')) {
                $depends_on_quantity = 1;
            } else {
                $depends_on_quantity = 0;
            }
            $category = Category::create([
                'name' => $request->name,
                'name_en' => $request->name_en,
                'alias' => $alias,
                'text' => $request->text,
                'text_en' => $request->text_en,
                'icon' => $request->icon,
                'parent_id' => $request->parent_id,
                'image' => $Image,
                'banner_image' => $Banner_image,
                'header_image' => $header_image_image,
                'description' => $request->description,
                'priority' => $request->priority,
                'depends_on_quantity' => $depends_on_quantity,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
            ]);
            if ($request->alias == null) {
                $category->update([
                    'alias' => $category->id,
                ]);
            }
            if ($request->measure_id != null) {
                $measure = Measure::where('id', $request->measure_id)->first();
                $category->Measures()->attach($measure);
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()->error('مشکل در ایجاد دسته بندی', $ex->getMessage())->persistent('حله');
            return redirect()->back();
        }

        alert()->success('دسته بندی مورد نظر ایجاد شد', 'باتشکر');
        return redirect()->route('admin.categories.index');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $parentCategories = Category::where('parent_id', 0)->get();
        $measures = Measure::all();
        return view('admin.categories.edit', compact('category', 'parentCategories', 'measures'));
    }

    public function update(Request $request, Category $category)
    {
                $currentPage = $request->session()->get('current_page', 1);
        $categories_already_exists = Category::where('name', $request->name)->where('parent_id', $request->parent_id)->first();
        if (isset($categories_already_exists) and $category->id != $categories_already_exists->id) {
            return redirect()->back()->withErrors(['msg' => 'این نام و والد  برای دسته بندی دیگری هم در حال استفاده است.لطفا نام دیگری انتخاب کنید']);
        }
        $request->validate([
            'parent_id' => 'required',
            'primary_image' => 'nullable|mimes:jpg,jpeg,png,svg',
            'banner_image' => 'nullable|mimes:jpg,jpeg,png,svg',
            'description' => 'nullable|string|max:60000',
            'alias' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:60000',
            'meta_description' => 'nullable|string|max:60000',
        ]);
        if ($request->alias != null) {
            $request->validate([
                'alias' => 'required|unique:products,alias,' . $category->id,
            ]);
            $alias = $request->alias;
            $alias = parent::aliasCreator($alias);
        } else {
            $alias = $category->id;
        }
        try {
            $Image = $category->image;
            if ($request->has('primary_image')) {
                $path = public_path(env('CATEGORY_IMAGES_UPLOAD_PATH') . $Image);
                if (file_exists($path) and !is_dir($path)) {
                    unlink($path);
                }
                $productImageController = new ProductImageController();
                $Image = $productImageController->categoryImageUpload($request->primary_image);
            }
            if ($request->has('banner_image')) {
                $path2 = public_path(env('CATEGORY_IMAGES_UPLOAD_PATH') . $request->banner_image);
                if (file_exists($path2) and !is_dir($path2)) {
                    unlink($path2);
                }
                $productImageController = new ProductImageController();
                $Banner_image = $productImageController->categoryImageUpload($request->banner_image);
            } else {
                $Banner_image = $category->banner_image;
            }
            if ($request->has('header_image')) {
                $path2 = public_path(env('CATEGORY_IMAGES_UPLOAD_PATH') . $request->header_image);
                if (file_exists($path2) and !is_dir($path2)) {
                    unlink($path2);
                }
                $productImageController = new ProductImageController();
                $header_image = $productImageController->categoryImageUpload($request->header_image);
            } else {
                $header_image = $category->header_image;
            }
            DB::beginTransaction();
            if ($request->has('depends_on_quantity')) {
                $depends_on_quantity = 1;
            } else {
                $depends_on_quantity = 0;
            }
            $category->update([
                'name' => $request->name,
                'name_en' => $request->name_en,
                'alias' => $alias,
                'text' => $request->text,
                'text_en' => $request->text_en,
                'icon' => $request->icon,
                'parent_id' => $request->parent_id,
                'is_active' => $request->is_active,
                'image' => $Image,
                'banner_image' => $Banner_image,
                'header_image' => $header_image,
                'description' => $request->description,
                'priority' => $request->priority,
                'depends_on_quantity' => $depends_on_quantity,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
            ]);

            if ($request->price_modify != 0) {
                $products_categories = $category->Products;
                foreach ($products_categories as $product) {
                    $modify = 1 + ($request->price_modify / 100);
                    $new_price = $product->price * $modify;
                    $product->update([
                        'price' => $new_price,
                        'sale_price' => ($product->sale_price) * $modify,
                    ]);
                    $product_attr_variations = ProductAttrVariation::where('product_id', $product->id)->get();
                    foreach ($product_attr_variations as $product_attr_variation) {
                        $product_attr_variation->update([
                            'price' => ($product_attr_variation->price) * $modify,
                        ]);
                    }
                    if ($request->has('option_price_modify')) {
                        $options = $product->options;
                        foreach ($options as $option) {
                            $pre_price = $option->price;
                            $new_price = $pre_price * $modify;
                            $option->update([
                                'price' => $new_price,
                            ]);
                        }
                    }
                }
            }

            $category->Measures()->detach();
            if ($request->measure_id != null) {
                $measure = Measure::where('id', $request->measure_id)->first();
                $category->Measures()->attach($measure);
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()->error('مشکل در ویرایش دسته بندی', $ex->getMessage())->persistent('حله');
            return redirect()->back();
        }
        alert()->success('دسته بندی مورد نظر ویرایش شد', 'باتشکر');
        return redirect()->route('admin.categories.index' ,['page'=>$currentPage]);
    }

    public function getCategoryAttributes(Category $category)
    {
        $attributes = $category->attributes()->wherePivot('is_variation', 0)->get();
        $variation = $category->attributes()->wherePivot('is_variation', 1)->first();
        return ['attrubtes' => $attributes, 'variation' => $variation];
    }

    public function remove(Request $request)
    {
        $category_id = $request->category_id;
        $category = Category::where('parent_id', $category_id)->get();
        $products = Product::where(function ($query) use ($category_id) {
            $query->where('category_id', 'LIKE', "%" . json_encode($category_id) . "%")
                ->orWhere('main_category_id', 'LIKE', "%" . json_encode($category_id) . "%")
                ->orWhere('category_id', $category_id)
                ->orWhere('main_category_id', $category_id);
        })->where('is_active', 1)->distinct()->get();
        if (sizeof($category) > 0) {
            $items = [];
            foreach ($category as $cat) {
                $item['name'] = $cat->name;
                $item['link'] = route('admin.categories.show', ['category' => $cat->id]);
                array_push($items, $item);
            }
            $msg = 'دسته‌بندی‌های زیر مربوط به این دسته‌بندی هستند.ابتدا باید دسته‌بندی‌های زیر را حذف کنید.';

            return response()->json([0, $msg, $items]);
        }
        if (sizeof($products)) {
            $msg = 'کالاهای زیر مربوط به این دسته‌بندی هستند.ابتدا باید کالاهای زیر را حذف کنید.';
            $items = [];
            foreach ($products as $product) {
                $item['name'] = $product->name;
                $item['link'] = route('admin.products.show', ['product' => $product->id]);
                array_push($items, $item);
            }
            return response()->json([0, $msg, $items]);
        }
        $category = Category::find($category_id);
        $category->delete();
        $msg = 'دسته‌بندی با موفقیت حذف شد';
        return response()->json([1, $msg]);
    }

    public function showOnIndex(Request $request)
    {
        $category_id = $request->category_id;
        $category = Category::where('id', $category_id)->first();
        $showOnIndex = $category->showOnIndex;
        if ($showOnIndex == 0) {
            $newShowOnIndex = 1;
        }
        if ($showOnIndex == 1) {
            $newShowOnIndex = 0;
        }
        $category->update([
            'showOnIndex' => $newShowOnIndex,
        ]);
        return \response()->json([1, $newShowOnIndex]);
    }

    public function sale_active(Request $request)
    {
        $category_id = $request->category_id;
        $category = Category::where('id', $category_id)->first();
        $sale_active = $category->is_sale;
        if ($sale_active == 0) {
            $new = 1;
        }
        if ($sale_active == 1) {
            $new = 0;
        }
        $category->update([
            'is_sale' => $new,
        ]);
        return \response()->json([1, $new]);
    }

    public function personalityNavbar()
    {
        $parent_ids = [];
        $parent_categories = Category::where('parent_id', 0)->get();
        foreach ($parent_categories as $parent_category) {
            array_push($parent_ids, $parent_category->id);
        }
        $categories = Category::whereIn('parent_id', $parent_ids)->get();
        return view('admin.categories.personalityNavbar', compact('categories'));
    }

    public function personalityNavbar_update(Request $request)
    {
        $ids = $request->ids;
        $parent_ids = [];
        $parent_categories = Category::where('parent_id', 0)->get();
        foreach ($parent_categories as $parent_category) {
            array_push($parent_ids, $parent_category->id);
        }
        $categories = Category::whereIn('parent_id', $parent_ids)->get();
        foreach ($categories as $category) {
            $category->update([
                'full_height' => 0
            ]);
        }
        if (!empty($ids)) {
            foreach ($ids as $id) {
                $category = Category::where('id', $id)->first();
                $category->update([
                    'full_height' => 1
                ]);
            }
        }
        alert()->success('تغییرات مورد نظر با موفقیت اعمال شد', 'باتشکر');
        return redirect()->back();
    }

    public function get(Request $request)
    {
        try {
            DB::beginTransaction();
            $name = $request->name;
            $categories = Category::where('name', 'LIKE', '%' . $name . '%')->get();
            $html = '';
            foreach ($categories as $category) {
                if ($category->showOnIndex == 1) {
                    $show_index_btn = 'btn-success text-white';
                    $show_index_text = 'فعال';
                } else {
                    $show_index_btn = 'btn-dark text-mute';
                    $show_index_text = 'غیر فعال';
                }
                if ($category->is_sale == 1) {
                    $show_is_sale = 'btn-success text-white';
                    $show_is_sale_text = 'فعال';
                } else {
                    $show_is_sale = 'btn-dark text-mute';
                    $show_is_sale_text = 'غیر فعال';
                }
                if ($category->getRawOriginal('is_active') == 1) {
                    $text_success = 'text-success';
                } else {
                    $text_success = '';
                }
                if ($category->parent_id == 0) {
                    $parent = 'بدون والد';
                } else {
                    $parent = $category->parent->name;
                }
                if (count($category->children)==0 and $category->parent_id!=0) {
                    $peyk_price = '<a href="'.route('admin.category.peyk.price',['category'=>$category->id]).'" class="btn btn-danger btn-sm">
                                        <i class="fa fa-truck"></i>
                                    </a>';
                } else {
                    $peyk_price = '-';
                }
                if (count($category->children)==0 and $category->parent_id!=0) {
                    $send_setting = '<a href="'.route('admin.category.send_setting.edit',['category'=>$category->id]).'" class="btn btn-warning btn-sm">
                                        <i class="fa fa-cogs"></i>
                                    </a>';
                } else {
                    $send_setting = '-';
                }
                $html = $html . '<tr>
                            <th>
                               -
                            </th>
                            <th>
                                ' . $category->name . '
                            </th>
                             <th>
                                ' . $category->priority . '
                            </th>
                            <th>
                                <img class="img-thumbnail"
                                     src="' . imageExist(env('CATEGORY_IMAGES_UPLOAD_PATH'), $category->image) . '">
                            </th>
                            <th>
                                <img class="img-thumbnail"
                                     src="' . imageExist(env('CATEGORY_IMAGES_UPLOAD_PATH'), $category->banner_image) . '">
                            </th>
                            <th>
                                <img class="img-thumbnail"
                                     src="' . imageExist(env('CATEGORY_IMAGES_UPLOAD_PATH'), $category->header_image) . '">
                            </th>
                            <th>
                                ' . $parent . '
                            </th>

                            <th>
                                    <span
                                        class="' . $text_success . '">
                                        ' . $category->is_active . '
                                    </span>
                            </th>
                            <th>
                                <a title="نمایش دسته‌بندی در صفحه اصلی" id="category_' . $category->id . '" onclick="showOnIndex(' . $category->id . ')"
                                   class="btn btn-sm ' . $show_index_btn . '">
                                    ' . $show_index_text . '
                                </a>
                            </th>
                            <th>
                                ' . $peyk_price . '
                            </th>

                            <th>
                                ' . $send_setting . '
                            </th>

                            <th>
                                <a title="فعال بودن فروش" id="saleActive_' . $category->id . '" onclick="saleActive(' . $category->id . ')"
                                   class="btn btn-sm ' . $show_is_sale . '">
                                    ' . $show_is_sale_text . '
                                </a>
                            </th>
                            <th>
                                <a title="مشاهده" class="btn btn-sm btn-success"
                                   href="' . route('admin.categories.show', ['category' => $category->id]) . '"><i
                                        class="fa fa-eye"></i></a>
                                <a title="ویرایش" class="btn btn-sm btn-info mr-3"
                                   href="' . route('admin.categories.edit', ['category' => $category->id]) . '"><i
                                        class="fa fa-edit"></i></a>
                                <button title="حذف" type="button" onclick="RemoveModal(' . $category->id . ')"
                                        class="btn btn-sm btn-danger mr-3"
                                        href=""><i class="fa fa-trash"></i></button>
                            </th>
                        </tr>';
            }
            DB::commit();
            return response()->json([1, $html]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([0, $exception->getMessage()]);
        }

    }

    public function send_setting(Category $category)
    {
        $delivery_methods = DeliveryMethod::where('is_active', 1)->get();
        $send_setting = unserialize($category->send_setting);
        return view('admin.categories.send_setting', compact('category', 'delivery_methods', 'send_setting'));
    }

    public function send_setting_update(Request $request, Category $category)
    {
        $methods = $request->methods;
        if ($methods == null) {
            $send_setting = null;
        } else {
            $send_setting = serialize($methods);
        }
        $category->update([
            'send_setting' => $send_setting,
        ]);
        return redirect()->back();

    }

    public function peyk_price(Category $category)
    {
        $tehran_or_alborz = Province::where('name', 'تهران')->orwhere('name', 'البرز')->get();
        $groups=CityGroup::where('id','!=',0)->get();
        foreach ($tehran_or_alborz as $item) {
            $cities = City::where('province_id', $item->id)->get();
            foreach ($cities as $city) {
                $peyk_price_exist=PeykPrice::
                where('category_id',$category->id)
                    ->where('province_id',$city->province_id)
                    ->where('city_id',$city->id)
                    ->exists();
                if (!$peyk_price_exist){
                    PeykPrice::create([
                        'category_id' => $category->id,
                        'province_id' => $city->province_id,
                        'city_id' => $city->id,
                    ]);
                }
            }
        }
        if (count($category->PeykPrice) == 0) {
            $tehran_or_alborz = Province::where('name', 'تهران')->orwhere('name', 'البرز')->get();
            foreach ($tehran_or_alborz as $item) {
                $cities = City::where('province_id', $item->id)->get();
                foreach ($cities as $city) {
                    PeykPrice::create([
                        'category_id' => $category->id,
                        'province_id' => $city->province_id,
                        'city_id' => $city->id,
                    ]);
                }
            }
        }
        $peyk_prices = PeykPrice::where('category_id', $category->id)->get();
        return view('admin.categories.peyk_prices', compact('peyk_prices', 'category','groups'));
    }

    public function peyk_price_update(Request $request)
    {
        try {
            $peyk_price_id = $request->peyk_price_id;
            $price = $request->price;
            $price = str_replace(',', '', $price);
            $peyk = PeykPrice::where('id', $peyk_price_id)->first();
            $peyk->update([
                'price' => $price
            ]);
            return \response()->json([1]);
        } catch (\Exception $exception) {
            return \response()->json([0, $exception->getMessage()]);
        }
    }
    public function peyk_price_group_update(Request $request)
    {
        try {
            $category_id = $request->category_id;
            $group_id = $request->group_id;
            $price = $request->price;
            $price = str_replace(',', '', $price);
            $group=CityGroup::where('id',$group_id)->first();
            $cities=$group->Cities;
            foreach ($cities as $city){
                $peyk_price=PeykPrice::where('category_id',$category_id)->where('city_id',$city->id)->first();
                $peyk_price->update([
                    'price' => $price
                ]);
            }
            return \response()->json([1]);
        } catch (\Exception $exception) {
            return \response()->json([0, $exception->getMessage()]);
        }
    }

}
