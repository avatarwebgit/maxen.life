<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Province;
use App\Models\TruckPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TruckController extends Controller
{
    public function index(Category $category)
    {
        try {
            $truck_price_exists = TruckPrice::where('category_id', $category->id)->exists();
            if (!$truck_price_exists) {
                $tehran = Province::where('name', 'تهران')->first();
                $sub_tehran = City::where('province_id', $tehran->id)->get();
                foreach ($sub_tehran as $item) {
                    TruckPrice::create([
                        'province_id' => $item->province_id,
                        'city_id' => $item->id,
                        'category_id' => $category->id,
                    ]);
                }
                $alborz = Province::where('name', 'البرز')->first();
                $sub_alborz = City::where('province_id', $alborz->id)->get();
                foreach ($sub_alborz as $item) {
                    TruckPrice::create([
                        'province_id' => $item->province_id,
                        'city_id' => $item->id,
                        'category_id' => $category->id,
                    ]);
                }
                TruckPrice::create([
                    'province_id' => 'دیگر شهرستان ها',
                    'city_id' => 'دیگر شهرستان ها',
                    'category_id' => $category->id,
                ]);
            }

            $truck_prices = TruckPrice::where('category_id', $category->id)->get();

            return view('admin.truck.index', compact('category', 'truck_prices'));
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            alert()->error('لطفا دوباره امتحان کنید');
            return redirect()->back();
        }
    }

    public function price_update(Request $request)
    {
        try {
            $id = $request->id;
            $price = $request->price;
            $price = str_replace(',', '',$price);
            TruckPrice::where('id', $id)->update([
                'price' => $price,
            ]);
            return response()->json([1]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([0, 'خطا در ویرایش قیمت']);
        }
    }
}
