<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\confirmRoleSms;
use App\Notifications\DenyRoleSms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    //return Users Ajax
    public function AjaxGet()
    {
        $users = User::where('role', '!=', 1)->get();
        return response()->json($users);
    }

    public function searchUser()
    {
        $name = $_POST['name'];
        $users = User::where('cellphone', 'LIKE', '%' . $name . '%')

            ->get();
        return response()->json($users);
    }

    public function index()
    {
        $users = User::latest()->paginate(20);
        $show_per_page = 1;
        $has_request_change_role = User::where('role_request_status', 1)->exists();
        return view('admin.users.index', compact('users', 'show_per_page','has_request_change_role'));
    }

    public function index_pagination($show_per_page)
    {
        if ($show_per_page === 'all') {
            $users_count = User::latest()->count();
            $users = User::latest()->paginate($users_count);
        } elseif ($show_per_page == 'default') {
            $users = User::latest()->paginate(20);
            $show_per_page = null;
        } else {
            $users = User::latest()->paginate($show_per_page);
        }
        return view('admin.users.index', compact('users', 'show_per_page'));
    }

    public function create()
    {
        $roles=Roles::OrderBy('id','desc')->get();
        return view('admin.users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'is_active' => 'required',
            'role' => 'required',
            'cellphone' => 'required|iran_mobile|unique:users,cellphone',
            'email' => 'nullable|email|unique:users,email',
            'tel' => 'nullable',
            'avatar' => 'nullable|mimes:jpg,jpeg,png,svg|max:1024',
        ]);
        try {
            DB::beginTransaction();
            if ($request->has('avatar')) {
                $fileNameImage = generateFileName($request->avatar->getClientOriginalName());
                $request->avatar->move(public_path(env('USER_IMAGES_UPLOAD_PATH')), $fileNameImage);
            }
            User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'is_active' => $request->is_active,
                'role' => $request->role,
                'cellphone' => $request->cellphone,
                'email' => $request->email,
                'tel' => $request->tel,
                'avatar' => $request->avatar,
                'cellphone_is_registered' => 1,
            ]);
            DB::commit();
            alert()->success('کاربر مورد نظر با موفقیت ایجاد شد', 'با تشکر')->persistent('ok');
            return redirect()->route('admin.user.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            alert()->error($exception->getMessage(), 'ERROR')->persistent('ok');
            return redirect()->back();
        }
    }

    public function edit(User $user)
    {
        $roles = Roles::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function userTickets(User $user)
    {
        $tickets = Ticket::where('user_id', $user->id)->latest()->paginate(20);
        return view('admin.users.tickets', compact('tickets'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'national_code' => 'nullable|melli_code',
            'cellphone' => 'required|iran_mobile|unique:users,cellphone,' . $user->id,
            'tel' => 'nullable',
            'avatar' => 'nullable|max:10000|mimes:png,jpg,jpeg,gif',
        ]);
        $avatar = $user->avatar;
        if ($request->has('avatar')) {
            $avatar = 'avatar' . time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path(env('USER_IMAGES_UPLOAD_PATH')), $avatar);
        }
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role' => $request->role,
            'cellphone' => $request->cellphone,
            'tel' => $request->tel,
            'avatar' => $avatar,
            'is_active' => $request->is_active,
            'national_code' => $request->national_code,
        ]);
        alert()->success('اطلاعات کاربر با موفقیت ویرایش شد', 'با تشکر');
        if ($request->close == 0) {
            return redirect()->back();
        }
        if ($request->close == 1) {
            return redirect()->route('admin.user.index');
        }
    }

    public function destroy(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::findOrFail($user_id);
        if ($user->getRawOriginal('role') == 1) {
            $msg = 'امکان حذف ادمین وجود ندارد';
            return response()->json([0, $msg]);
        }
        $path = public_path(env('USER_IMAGES_UPLOAD_PATH') . $user->avatar);
        if (file_exists($path) and !is_dir($path)) {
            unlink($path);
        }
        $msg = 'کاربر مورد نظر با موفقیت حذف شد';
        $user->delete();
        return response()->json([1, $msg]);

    }

    public function change_role_index()
    {
        $users = User::where('role_request_status', 1)->get();
        return view('admin.users.change_role.index', compact('users'));
    }

    public function change_role_edit(User $user)
    {
        $roles = Roles::where('id', '!=', 1)->get();
        return view('admin.users.change_role.edit', compact('user', 'roles'));
    }

    public function change_role_confirm(Request $request)
    {
        try {
            DB::beginTransaction();
            $user_id = $request->user_id;
            $role = Roles::where('name','legal')->first();
            $user = User::where('id', $user_id)->first();
            $user->update([
                'role' => $role->id,
                'role_request_status' => 0,
            ]);
            try {
                $user->notify(new confirmRoleSms());
            }catch (\Exception $exception){
                Log::error('confirm role SMS: '.$exception->getMessage());
            }

            DB::commit();
            return response()->json([1]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([0, $exception->getMessage()]);
        }
    }

    public function change_role_deny(Request $request)
    {
        try {
            DB::beginTransaction();
            $user_id = $request->user_id;
            $user = User::where('id', $user_id)->first();
            $user->update([
                'role_request_status' => 2,
            ]);
            try {
                $user->notify(new DenyRoleSms());
            }catch (\Exception $exception){
                Log::error('Deny role SMS: '.$exception->getMessage());
            }
            DB::commit();
            return response()->json([1]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([0, $exception->getMessage()]);
        }
    }
  public function get(Request $request)
    {
        try {
            DB::beginTransaction();
            $name = $request->name;
            $users = User::where('first_name', 'LIKE', '%' . $name . '%')->orWhere('cellphone', 'LIKE', '%' . $name . '%')->orWhere('last_name', 'LIKE', '%' . $name . '%')->get();
            $html = '';
            foreach ($users as $item) {
                if ($item->is_active == 0) {
                    $active = 'bg-danger text-white';
                    $text_white = 'text-white';
                    $text = 'غیر فعال';
                } else {
                    $active = '';
                    $text_white = '';
                    $text = 'فعال';
                }
                if (isset($item->Role->display_name)) {
                    $display_name = $item->Role->display_name;
                } else {
                    $display_name = '-';
                }
                $html = $html . '<tr class="' . $active . '">
                                        <td>
                                            -
                                        </td>
                                        <td>
                                            <a class="' . $text_white . '" href="' . route('admin.user.edit', ['user' => $item->id]) . '">
                                            ' . $item->first_name . ' ' . $item->last_name. '
                                            </a>
                                        </td>
                                        <td>
                                            ' . $item->cellphone . '
                                        </td>
                                        <td>
                                            ' . $display_name . '
                                        </td>
                                        <td>
                                            ' . $text . '
                                        </td>
                                        <td>
                                            <a href="' . route('admin.user.edit', ['user' => $item->id]) . '"
                                               class="btn btn-info btn-sm">
                                                <i class="fa fa-user"></i>
                                            </a>
                                            <button type="button" onclick="removeModal(' . $item->id . ')"
                                                    class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>';
            }
            DB::commit();
            return response()->json([1, $html]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([0, $exception->getMessage()]);
        }

    }

    public function change_password(Request $request,User $user)
    {
        $request->validate([
            'password'=>'required|min:4|same:password_confirmation'
        ]);
        try {
            $user->update([
                'password'=>Hash::make($request->password)
            ]);
            alert()->success('رمز عبور کاربر با موفقیت تغییر یافت');
            return redirect()->back();
        }catch (\Exception $exception){
            Log::error('change_pass_error:'.$exception->getMessage());
            alert()->error('خطا در تغییر رمز عبور');
            return redirect()->back();
        }

    }
}
