<?php

namespace App\Http\Controllers\Home;

use App\Models\City;
use App\Models\Province;
use App\Models\User;
use App\Models\UserAddress;
use App\Notifications\UserUpdateProfileNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = UserAddress::where('user_id', auth()->id())->get();
        $provinces = Province::all();
        $user = User::find(auth()->id());
        return view('home.users_profile.addresses', compact('provinces', 'addresses', 'user'));
    }

    public function store(Request $request)
    {

        $user_id = auth()->id();
        $user = User::where('id', $user_id)->first();
        $request->validateWithBag('addressStore', [
            'first_name' => $request->has('first_name') ? 'required' : '',
            'last_name' => $request->has('last_name') ? 'required' : '',
            'national_code' => $request->has('national_code') ? 'required|melli_code' : '',
            'title' => 'required',
            'tel' => 'required|min:11|max:14',
            'province_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
        ]);

        try {


            UserAddress::create([
                'user_id' => $user_id,
                'title' => $request->title,
                'cellphone' => $user->cellphone,
                'tel' => $request->tel,
                'province_id' => $request->province_id,
                'city_id' => $request->city_id,
                'address' => $request->address,
            ]);
            if ($request->has('first_name')) {

                $user->update([
                    'first_name' => $request->first_name
                ]);
            }
            if ($request->has('last_name')) {
                $user->update([
                    'last_name' => $request->last_name
                ]);
            }
            if ($request->has('national_code')) {
                $user->update([
                    'national_code' => $request->national_code
                ]);
            }

            // try {
            //     $user->notify(new UserUpdateProfileNotification(1));
            // } catch (\Exception $exception) {
            //     Log::error('UserUpdateProfileNotification Error: ' . $exception->getMessage());
            // }

        alert()->success('آدرس جدید ایجاد شد' )->autoclose(5000);
        } catch (\Exception $exception) {
            DB::rollBack();
            alert()->error($exception->getMessage())->persistent('ok');
        }
        return redirect()->back();
    }

    public function update(Request $request, UserAddress $address)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'tel' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'postal_code' => 'nullable|iran_postal_code'
        ]);
        if ($validator->fails()) {
            $validator->errors()->add('address_id', $address->id);
            return redirect()->back()->withErrors($validator, 'addressUpdate')->withInput();
        }
        $address->update([
            'title' => $request->title,
            'tel' => $request->tel,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'postal_code' => $request->postal_code
        ]);
        alert()->success('آدرس مورد نظر ویرایش شد')->autoclose(5000);
        return redirect()->route('home.addresses.index');
    }

    public function delete(UserAddress $address)
    {
        try {
            $address->delete();
            // $user = $address->User;
            // $user->notify(new UserUpdateProfileNotification(1));
        } catch (\Exception $exception) {
            Log::error('UserUpdateProfileNotification Error: ' . $exception->getMessage());
        }
        alert()->success('آدرس مورد نظر حذف شد')->autoclose(5000);
        return redirect()->back();
    }

    public function getProvinceCitiesList(Request $request)
    {
        return City::where('province_id', $request->province_id)->get();
    }
}
