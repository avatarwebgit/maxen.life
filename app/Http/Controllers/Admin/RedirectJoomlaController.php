<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Redirect;
use Illuminate\Http\Request;

class RedirectJoomlaController extends Controller
{
    public function index()
    {
        $redirects = Redirect::latest()->get();
        return view('admin.redirect.index', compact('redirects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'old' => 'required',
            'new' => 'required',
        ]);

        $old=str_replace(' ','',$request->old);
        $new=str_replace(' ','',$request->new);
        Redirect::create([
            'old' => $old,
            'new' => $new,
        ]);

        alert()->success('آدرس جدید با موفقیت اضافه شد')->autoclose('ok');
        return \redirect()->back();
    }

    public function remove(Request $request)
    {
        try {
            $row_id = $request->row_id;
            $redirect = Redirect::where('id',$row_id)->first();
            $redirect->delete();
            return response()->json([1,'آیتم مورد نظر باموفقیت حذف شد']);
        }catch (\Exception $exception){
            return response()->json([0,$exception->getMessage()]);
        }

    }
}
