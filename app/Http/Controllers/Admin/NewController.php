<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Slider;
use Illuminate\Http\Request;

class NewController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(20);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png,svg|max:10048',

        ]);

        $fileNameImage = uploadImage($request->image,env('SLIDER_IMAGES_UPLOAD_PATH'));


        News::create([
            'image' => $fileNameImage,
            'link'=>$request->link
        ]);

        alert()->success('تصویر مورد نظر ایجاد شد', 'باتشکر');
        return redirect()->route('admin.news.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(News $news)
    {
        
        return view('admin.news.edit', compact('news'));
    }


    public function update(Request $request, News $news)
    {
        $request->validate([
            'image' => 'nullable|mimes:jpg,jpeg,png,svg|max:10048',
        ]);
        $fileNameImage = $news->image;
        if ($request->has('image')) {
            $fileNameImage = uploadImage($request->image,env('SLIDER_IMAGES_UPLOAD_PATH'));
            $path=public_path(env('SLIDER_IMAGES_UPLOAD_PATH').$news->image);
            if (file_exists($path) and !is_dir($path)){
                unlink($path);
            }
        }

        $news->update([
            'image' => $fileNameImage,
               'link'=>$request->link
        ]);

        alert()->success('تصویر مورد نظر ویرایش شد', 'باتشکر');
        return redirect()->route('admin.news.index');
    }

    public function destroy(News $news)
    {
        $path=public_path(env('SLIDER_IMAGES_UPLOAD_PATH').$news->image);
        if (file_exists($path) and !is_dir($path)){
            unlink($path);
        }

        $news->delete();

        alert()->success('تصویر مورد نظر حذف شد', 'باتشکر');
        return redirect()->route('admin.news.index');
    }
}
