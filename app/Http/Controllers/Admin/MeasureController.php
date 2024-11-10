<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Measure;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MeasureController extends Controller
{

    public function index()
    {
        $measures = Measure::latest()->paginate(20);
        return view('admin.measures.index' , compact('measures'));
    }
    public function create()
    {
        return view('admin.measures.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:measures,title',
        ]);

        Measure::create([
            'title' => $request->title,
        ]);

        alert()->success('واحد اندازه گیری ایجاد شد', 'باتشکر');
        return redirect()->route('admin.measures.index');
    }

    public function edit(Measure $measure)
    {
        return view('admin.measures.edit' , compact('measure'));
    }
    public function update(Request $request, Measure $measure)
    {
        $request->validate([
            'title' => 'required|unique:measures,title,'.$measure->id,
        ]);

        $measure->update([
            'title' => $request->title,
        ]);

        alert()->success('واحد اندازه گیری مورد نظر ویرایش شد', 'باتشکر');
        return redirect()->route('admin.measures.index');
    }
    public function remove(Request $request){
        $id=$request->id;
        $measure=Measure::find($id);
        $measure->delete();
        $msg='مورد انتخابی با موفقیت حذف شد';
        return response()->json([1,$msg]);
    }

}
