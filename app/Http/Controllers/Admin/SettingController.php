<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnimationBanner;
use App\Models\Category;
use App\Models\PaymentMethods;
use App\Models\Section;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{


    public function edit(Setting $setting)
    {
        return view('admin.setting.edit', compact('setting'));
    }


    public function setting_title($section)
    {
        $setting = Setting::first();
        return view('admin.setting.title',compact('setting','section'));
    }
    public function setting_title_update(Request $request)
    {

        $setting = Setting::first();
      
    

try{
   $setting->update($request->except('_token'));
}catch(\Exception $e){
    dd($e->getMessage());
}
 
            alert()->success('با موفقیت آپدیت شد.');

            return redirect()->back();
    }

    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string|max:500',
            'shomare_sabt' => 'nullable|string|max:50',

            'footer_about' => 'nullable',


         
            'EconomicCode' => 'nullable',
            'postalCode' => 'nullable|iran_postal_code',
            'productCode' => 'nullable',
     
            'message' => 'nullable|string',
            'instagram' => 'nullable|string',
            'image' => 'nullable|image',
            'mohr' => 'nullable|image',
            'mohr_role' => 'nullable|image',
            'special_page_banner' => 'nullable|image',
            'newest_page_banner' => 'nullable|image',
            'special_discount_banner' =>'nullable|image',
        ]);

        $Image = $setting->image;
        if ($request->has('image')) {
            $productImageController = new ProductImageController();
            $Image = $productImageController->logoUpload($request->image);
            $path = public_path(env('LOGO_UPLOAD_PATH') . $setting->image);
            if (file_exists($path) & !is_dir($path)) {
                unlink($path);
            }
        }
        
         $favicon = $setting->favicon;
        if ($request->has('favicon')) {
            $productImageController = new ProductImageController();
            $favicon = $productImageController->logoUpload($request->favicon);
            $path = public_path(env('LOGO_UPLOAD_PATH') . $setting->favicon);
            if (file_exists($path) & !is_dir($path)) {
                unlink($path);
            }
        }
        $special_page_banner = $setting->special_page_banner;
        if ($request->has('special_page_banner')) {
            $special_page_banner = generateFileName($request->special_page_banner->getClientOriginalName());
            $request->special_page_banner->move(public_path(env('BANNER_PAGES_UPLOAD_PATH')), $special_page_banner);
            $path = public_path(env('BANNER_PAGES_UPLOAD_PATH') . $setting->special_page_banner);
            if (file_exists($path) & !is_dir($path)) {
                unlink($path);
            }
        }
        $special_discount_banner = $setting->special_discount_banner;
        if ($request->has('special_discount_banner')) {
            $special_discount_banner = generateFileName($request->special_discount_banner->getClientOriginalName());
            $request->special_discount_banner->move(public_path(env('BANNER_PAGES_UPLOAD_PATH')), $special_discount_banner);
            $path = public_path(env('BANNER_PAGES_UPLOAD_PATH') . $setting->special_discount_banner);
            if (file_exists($path) & !is_dir($path)) {
                unlink($path);
            }
        }
        $newest_page_banner = $setting->newest_page_banner;
        if ($request->has('newest_page_banner')) {
            $newest_page_banner = generateFileName($request->newest_page_banner->getClientOriginalName());
            $request->newest_page_banner->move(public_path(env('BANNER_PAGES_UPLOAD_PATH')), $newest_page_banner);
            $path = public_path(env('BANNER_PAGES_UPLOAD_PATH') . $setting->newest_page_banner);
            if (file_exists($path) & !is_dir($path)) {
                unlink($path);
            }
        }

        $mohr = $setting->mohr;
        if ($request->has('mohr')) {
            $mohr = generateFileName($request->mohr->getClientOriginalName());
            $request->mohr->move(public_path(env('MOHR_UPLOAD_PATH')), $mohr);
            $path = public_path(env('MOHR_UPLOAD_PATH') . $setting->mohr);
            if (file_exists($path) & !is_dir($path)) {
                unlink($path);
            }
        }

           $mohr_role = $setting->mohr_role;
        if ($request->has('mohr_role')) {
            $mohr_role = generateFileName($request->mohr_role->getClientOriginalName());
            $request->mohr_role->move(public_path(env('MOHR_UPLOAD_PATH')), $mohr_role);
            $path = public_path(env('MOHR_UPLOAD_PATH') . $setting->mohr_role);
            if (file_exists($path) & !is_dir($path)) {
                unlink($path);
            }
        }
        if ($request->has('base_lang')) {
                 config('locale', $request->get('base_lang'));
                 app()->setLocale($request->get('base_lang'));
        }

        $setting->update([
            'name' => $request->name,

            'shomare_sabt' => $request->shomare_sabt,
            'postalCode' => $request->postalCode,
            'productCode' => $request->productCode,
            'footer_about' => $request->footer_about,

            'base_lang' => $request->base_lang,
            'question_link' => $request->question_link,
            'info_link' => $request->info_link,
            'login_link' => $request->login_link,
            'support_link' => $request->support_link,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
            'linkedin' => $request->linkedin,
            'twitter' => $request->twitter,
            'aparat'=>$request->aparat,
            'image' => $Image,
            'newest_page_banner' => $newest_page_banner,
            'special_page_banner' => $special_page_banner,
            'special_discount_banner' => $special_discount_banner,
            'mohr' => $mohr,
            'mohr_role' => $mohr_role,
            'favicon'=>$favicon,


            'EconomicCode' => $request->EconomicCode,
            'message' => $request->message,
                        'meta_des'=>$request->meta_des,
            'meta_key'=>$request->meta_key,
            'meta_title'=>$request->meta_title,

        ]);

        alert()->success('اطلاعات با موفقیت ویرایش شد', 'باتشکر');
        return redirect()->back();
    }
    
    public function contact_edit()
    {
              $setting = Setting::first();
                return view('admin.contact.edit', compact('setting'));

    }
    
    
        public function contact_update(Request $request)
    {
              $setting = Setting::first();
                    

try{
   $setting->update($request->except('_token'));
}catch(\Exception $e){
    dd($e->getMessage());
}
 
            alert()->success('با موفقیت آپدیت شد.');

            return redirect()->back();

    }

    public function priority_show_active(Request $request)
    {
        $setting = Setting::first();
        $sort = $request->sort;
        $setting->update([
            'product_sort' => $sort
        ]);
        return response()->json([1, 'ok']);
    }

    public function animation_banner_edit()
    {
        $animation_banner = AnimationBanner::first();
        return view('admin.setting.animation_banner', compact('animation_banner'));
    }

    public function animation_banner_update(Request $request)
    {
        $animation_banner = AnimationBanner::first();
        $animation_banner->update([
            'black_text' => $request->black_text,
            'red_text' => $request->red_text,
            'animation_text' => $request->animation_text,
            'btn_text' => $request->btn_text,
            'btn_link' => $request->btn_link,
            'is_active' => $request->is_active,
        ]);
        alert()->success('اطلاعات با موفقیت ویرایش شد', 'باتشکر');
        return redirect()->back();
    }

    public function sections_index()
    {
        $sections = Section::all();
        $categories = Category::orderby('priority','asc')->where('parent_id',0)->get();
        return view('admin.setting.sections', compact('sections', 'categories'));
    }

    public function sections_update(Request $request)
    {
        try {
            $ids = $request->except(['_token', '_method']);
            foreach ($ids as $id => $category_id) {
                Section::find($id)->update(['category_id' => $category_id]);
            }
            alert()->success('به روز رسانی با موفقیت انجام شد');
        } catch (\Exception $exception) {
            alert()->error('Error...' . $exception->getMessage())->persistent('ok');
        }

        return redirect()->back();

    }


}
