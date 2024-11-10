<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{

    public function index()
    {
        $brands = Brand::latest()->paginate(20);
        return view('admin.brands.index' , compact('brands'));
    }
    public function create()
    {
        return view('admin.brands.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands,name',
            'image' => 'nullable|mimes:jpg,jpeg,png,svg',
            'description' => 'nullable|string|max:60000',
        ]);

        if ($request->has('image')){
            $fileNameImage = generateFileName($request->image->getClientOriginalName());
            $request->image->move(public_path(env('BRAND_UPLOAD_PATH')), $fileNameImage);
        }else{
            $fileNameImage=null;
        }
        if ($request->alias != null) {
            $request->validate([
                'alias' => 'required|unique:brands,alias',
            ]);
            $alias = $request->alias;
            $alias = parent::aliasCreator($alias);
        } else {
            $alias = null;
        }
        Brand::create([
            'name' => $request->name,
            'meta_des' => $request->meta_des,
            'image' => $fileNameImage,
            'alias' => $alias,
            'description' => $request->description,
        ]);

        alert()->success('برند مورد نظر ایجاد شد', 'باتشکر');
        return redirect()->route('admin.brands.index');
    }
    public function show(Brand $brand)
    {
        return view('admin.brands.show' , compact('brand'));
    }
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit' , compact('brand'));
    }
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|unique:brands,name,'.$brand->id,
            'image' => 'nullable|mimes:jpg,jpeg,png,svg',
            'description' => 'nullable|string|max:60000',
        ]);


        if ($request->has('image')){
            $fileNameImage = generateFileName($request->image->getClientOriginalName());
            $request->image->move(public_path(env('BRAND_UPLOAD_PATH')), $fileNameImage);
            $path=public_path(env('BRAND_UPLOAD_PATH').$brand->image);
            unlink_image_helper_function($path);
        }else{
            $fileNameImage=$brand->image;
        }
          if ($request->alias != null) {
            $request->validate([
                'alias' => 'required|unique:brands,alias,' . $brand->id,
            ]);
            $alias = $request->alias;
            $alias = parent::aliasCreator($alias);
        } else {
            $alias = $brand->id;
        }

        $brand->update([
            'name' => $request->name,
             'meta_des' => $request->meta_des,
            'image' => $fileNameImage,
            'alias' => $alias,
            'description' => $request->description,
        ]);

        alert()->success('برند مورد نظر ویرایش شد', 'باتشکر');
        return redirect()->route('admin.brands.index');
    }
    public function remove(Request $request){
        $id=$request->id;
        $brand=Brand::where('id',$id)->first();
        $products=$brand->Products;
        if (sizeof($products)){
            $msg='کالاهای زیر مربوط به این دسته‌بندی هستند.ابتدا باید کالاهای زیر را حذف کنید.';
            $items=[];
            foreach ($products as $product){
                $item['name']=$product->name;
                $item['link']=route('admin.products.edi',['product'=>$product->id]);
                array_push($items,$item);
            }
            return response()->json([0,$msg,$items]);
        }
        $path=public_path(env('BRAND_UPLOAD_PATH').$brand->image);
        unlink_image_helper_function($path);
        $brand->delete();
        $msg='برند با موفقیت حذف شد';
        return response()->json([1,$msg]);
    }

}
