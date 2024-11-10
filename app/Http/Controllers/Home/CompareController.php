<?php

namespace App\Http\Controllers\Home;

use App\Models\Attribute;
use App\Models\AttributeValues;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Diff\Exception;

class CompareController extends Controller
{
    public function add(Request $request)
    {
        $productId=$request->productId;
        if (session()->has('compareProducts')) {
            if (in_array($productId, session()->get('compareProducts'))) {
                return response()->json(['exist']);
            }
            $count=count(session()->get('compareProducts'));
            if ($count>3){
                return response()->json(['full']);
            }
            session()->push('compareProducts', $productId);
        } else {
            session()->put('compareProducts', [$productId]);
        }

      return response()->json(['ok']);
    }
    public function get(){
        $productsInCart='';
        $ids=session()->get('compareProducts');
        $products = Product::findOrFail($ids);
        $lastKey = $products->keys()->last();
        $src= route('home.compare');

            $text = app()->getLocale() == 'fa' ? 'مشاهده لیست مقایسه  ': 'Compare List' ;
        foreach ($products as $key => $product){
            if($key == $lastKey){
                $html = ' <div class="card">
        <div class="card-header">
               <p class="title-popup"></p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-7">
                    <img src="' . imageExist(env('PRODUCT_IMAGES_UPLOAD_PATH'), $product->primary_image) . '" class="img-popup">
                </div>
                <div class="col-5 d-flex justify-content-center align-items-center">
                    <p class="name-popup">
                    ' . $product->name . '
                    </p>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-center align-items-center">
            <a href="'.$src.'" class="text-center">
           '.$text .'
            </a>
        </div>
    </div>';
            }
         

        }
        
    
        
        
        return response()->json(['ok',count(session()->get('compareProducts')),$html]);
    }

    public function index()
    {
        if (!session()->has('compareProducts')) {
            alert()->warning('در ابتدا باید محصولی برای مقایسه اضافه کنید', 'دقت کنید');
            return redirect()->back();
        }

        $ids=session()->get('compareProducts');
        $product_ids=[];
        $products = Product::findOrFail($ids);
        foreach ($products as $product) {
            array_push($product_ids, $product->id);
        }
        $attribute_values=ProductAttribute::whereIn('product_id',$product_ids)->get();
        $attribute_ids=[];
        foreach ($attribute_values as $attribute_value){
            array_push($attribute_ids, $attribute_value->attribute_id);
        }
        $attribute_ids=array_unique($attribute_ids);
        $attributes=Attribute::whereIn('id',$attribute_ids)->orderby('priority','ASC')->get();
        $attribute_group_ids=[];
        
        foreach ($attributes as $attribute){
         
       if(isset($attribute->Group)){
                      array_push($attribute_group_ids, $attribute->Group->id);
       }
        }
        $attribute_group_ids=array_unique($attribute_group_ids);

        $attr_group = [];
        foreach ($attributes as $attribute){
            foreach ($attribute_group_ids as $group_id){
                
                if(isset($attribute->Group)){
                     if($attribute->Group->id == $group_id){
                    $attr_group[$group_id][]= $attribute;
                }
                
                }
               
            }
        }






        return view('home.compare', compact('products','attr_group'));
    }

    public function remove($productId)
    {
        if (session()->has('compareProducts')) {
            foreach (session()->get('compareProducts') as $key => $item) {
                if ($item == $productId) {
                    session()->pull('compareProducts.' . $key);
                }
            }
            if (session()->get('compareProducts') == []) {
                session()->forget('compareProducts');
                 alert()->success('محصول از لیست مقایسه حذف شد');
                return redirect()->route('home.index');
            }
       alert()->success('محصول از لیست مقایسه حذف شد');
            return redirect()->route('home.compare');
        }

        alert()->warning('در ابتدا باید محصولی برای مقایسه اضافه کنید', 'دقت کنید');
        return redirect()->back();
    }
    public function remove_sideBar(Request $request)
    {
        try {
            DB::beginTransaction();
            if (session()->has('compareProducts')) {
                foreach (session()->get('compareProducts') as $key => $item) {
                    if ($item == $request->product_id) {
                        session()->pull('compareProducts.' . $key);
                    }
                }
                DB::commit();
                return response()->json([1]);
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return response()->json([0,$exception->getMessage()]);
        }


    }
}
