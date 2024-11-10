<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CityGroup;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{

    public function index()
    {
        $provinces = Province::orderby('name')->paginate(40);
        return view('admin.provinces.index', compact('provinces'));
    }


    public function create()
    {
        return view('admin.provinces.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:provinces,name',
        ]);

        Province::create([
            'name' => $request->name,
        ]);

        alert()->success('استان مورد نظر ایجاد شد', 'باتشکر');
        return redirect()->route('admin.provinces.index');
    }


    public function edit(Province $province)
    {
        return view('admin.provinces.edit', compact('province'));
    }


    public function update(Request $request, Province $province)
    {
        $request->validate([
            'name' => 'required|unique:provinces,name,' . $province->id,
        ]);


        $province->update([
            'name' => $request->name,
        ]);

        alert()->success('استان مورد نظر ویرایش شد', 'باتشکر');
        return redirect()->route('admin.provinces.index');
    }


    public function province_remove(Request $request)
    {
        $province = Province::where('id', $request->id)->first();
        $province->delete();
        $msg = 'استان با موفقیت حذف شد';
        return response()->json([1, $msg]);
    }

    //Cities
    public function cities_index(Province $province)
    {
        $cities = $province->Cities()->orderby('name')->get();
        return view('admin.provinces.cities.index', compact('province', 'cities'));
    }

    public function city_create(Province $province)
    {
        $group = CityGroup::all();
        return view('admin.provinces.cities.create', compact('province','group'));
    }

    public function city_store(Request $request, $province)
    {
        $request->validate([
            'name' => 'required|unique:cities,name',
        ]);

        City::create([
            'name' => $request->name,
            'province_id' => $province,
            'group_id' => $request->group,
        ]);

        alert()->success('شهر مورد نظر ایجاد شد', 'باتشکر');
        return redirect()->route('admin.cities.index', ['province' => $province]);
    }

    public function city_edit(City $city)
    {
        $groups = CityGroup::all();
        return view('admin.provinces.cities.edit', compact('city','groups'));
    }

    public function city_update(Request $request, City $city)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $city->update([
            'name' => $request->name,
            'group_id' => $request->group,
        ]);
        alert()->success('شهر مورد نظر ایجاد شد', 'باتشکر');
        return redirect()->route('admin.cities.index', ['province' => $city->province_id]);
    }

    public function city_remove(Request $request)
    {
        $city = City::where('id', $request->id)->first();
        $city->delete();
        $msg = 'شهر با موفقیت حذف شد';
        return response()->json([1, $msg]);
    }
    //Groups
    public function groups_index()
    {
        $groups = CityGroup::all();
        return view('admin.provinces.group.index', compact('groups'));
    }

    public function group_create()
    {
        return view('admin.provinces.group.create');
    }

    public function group_store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:group_cities,title',
        ]);
        CityGroup::create([
            'title' => $request->title,
        ]);
        alert()->success('گروه مورد نظر ایجاد شد', 'باتشکر');
        return redirect()->route('admin.groups.index');
    }

    public function group_edit(CityGroup $group)
    {
        return view('admin.provinces.group.edit', compact('group'));
    }

    public function group_update(Request $request,CityGroup $group)
    {
        $request->validate([
            'title' => 'required|unique:group_cities,title,'.$group->id,
        ]);
        $group->update([
            'title' => $request->title,
        ]);
        alert()->success('گروه مورد نظر ویرایش شد', 'باتشکر');
        return redirect()->route('admin.groups.index');
    }

    public function group_remove(Request $request)
    {
        $group = CityGroup::where('id', $request->id)->first();
        $group->delete();
        $msg = 'گروه با موفقیت حذف شد';
        return response()->json([1, $msg]);
    }
}
