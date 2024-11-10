<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::paginate();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:pages,title',
            'image' => 'nullable|mimes:jpg,jpeg,png,svg',
        ]);
         if ($request->alias != null) {
            $request->validate([
                'alias' => 'required|unique:pages,alias',
            ]);
            $alias = $request->alias;
            $alias = parent::aliasCreator($alias);
        } else {
            $alias = null;
        }
        if ($request->has('image')) {


                $fileNameImage = str_replace(' ','_',generateFileName($request->image->getClientOriginalName())) ;
            $request->image->move(public_path(env('BANNER_PAGES_UPLOAD_PATH')), $fileNameImage);
        } else {
            $fileNameImage = null;
        }
        Page::create([
            'title' => $request->title,
            'description' => $request->description,
            'title_en' => $request->title_en,
            'description_en' => $request->description_en,
            'priority' => $request->priority,
            'banner_is_active' => $request->banner_is_active,
            'alias' => $alias,
            'image' => $fileNameImage,
        ]);
        alert()->success('صفحه جدید با موفقیت ایجاد شد', 'باتشکر');
        return redirect()->route('admin.pages.index');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|unique:pages,title,' . $page->id,
            'image' => 'nullable|mimes:jpg,jpeg,png,svg',
        ]);
         if ($request->alias != null) {
            $request->validate([
                'alias' => 'required|unique:pages,alias,' . $page->id,
            ]);
            $alias = $request->alias;
            $alias = parent::aliasCreator($alias);
        } else {
            $alias = $page->id;
        }
        if ($request->has('image')) {
            $image_name = str_replace(' ','_',$page->image);

            $path=public_path(env('BANNER_PAGES_UPLOAD_PATH').$image_name);
            unlink_image_helper_function($path);
            $fileNameImage = str_replace(' ','_',generateFileName($request->image->getClientOriginalName())) ;


            $request->image->move(public_path(env('BANNER_PAGES_UPLOAD_PATH')), $fileNameImage);
        } else {
            $image_name = str_replace(' ','_',$page->image);

            $fileNameImage = $image_name;
        }


        $page->update([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'title_en' => $request->title_en,
            'description_en' => $request->description_en,
            'alias'=> $alias,
            'banner_is_active' => $request->banner_is_active,
            'image' => $fileNameImage,
        ]);
        alert()->success('صفحه با موفقیت ویرایش شد', 'باتشکر');
        return redirect()->route('admin.pages.index');
    }

    public function destroy(Request $request)
    {
        Page::where('id', $request->id)->delete();
        alert()->success('صفحه با موفقیت حذف شد', 'باتشکر');
        return redirect()->back();
    }

}
