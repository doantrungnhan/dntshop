<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;
use Carbon\Carbon;

class UserController extends Controller
{
    // users
    public function users(Request $request)
    {
        $search = $request->input('name');

        if ($search) {
            $users = User::where('full_name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orderBy('UserID', 'asc')
                ->paginate(10);
        } else {
            $users = User::orderBy('UserID', 'asc')->paginate(10);
        }


        return view('admin.users', compact('users', 'search'));
    }

    public function user_add()
    {
        return view('admin.user-add');
    }

    public function user_store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:0,1',
            'avatar' => 'required|mimes:jpeg,jpg,png|max:2048',
        ], [
            'full_name.required' => 'Tên không được để trống!',
            'full_name.max' => 'Tên không được vượt quá 255 ký tự!',
    
            'email.required' => 'Email không được để trống!',
            'email.max' => 'Email không được vượt quá 255 ký tự!',
            'email.unique' => 'Email đã được sử dụng!',
    
            'phone.required' => 'Số điện thoại không được để trống!',
            'phone.max' => 'Số điện thoại không được vượt quá 255 ký tự!',
    
            'address.required' => 'Địa chỉ không được để trống!',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự!',
    
            'password.required' => 'Mật khẩu không được để trống!',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự!',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp!',
    
            'role.required' => 'Vai trò không được để trống!',
            'role.in' => 'Vai trò không hợp lệ!',
    
            'avatar.required' => 'Ảnh đại diện không được để trống!',
            'avatar.mimes' => 'Ảnh đại diện phải có định dạng jpeg, jpg hoặc png!',
            'avatar.max' => 'Ảnh đại diện không được vượt quá 2MB!',
        ]);
    

        $user = new User();
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $file_extension = $avatar->extension();
            $file_name = Carbon::now()->timestamp . '.' . $file_extension;
            $avatar->move(public_path('uploads/avatars'), $file_name);
            $user->avatar = $file_name;
        }

        $user->save();

        return redirect()->route('admin.users')->with('status', 'Người dùng đã được thêm');
    }

    public function user_edit($userID)
    {
        $user = User::find($userID);
        return view('admin.user-edit', compact('user'));
    }

    public function user_update(Request $request)
    {
        $request->validate([
            'role' => 'required|in:1,0',
            'avatar' => 'required|mimes:jpeg,jpg,png|max:2048',
        ]);

        $user = User::find($request->userID);
        if ($user) {
            $user->role = $request->role;

            if ($request->hasFile('avatar')) {
                if (File::exists(public_path('uploads/avatars') . '/' . $user->avatar)) {
                    File::delete(public_path('uploads/avatars') . '/' . $user->avatar);
                }
                $avatar = $request->file('avatar');
                $file_extension = $avatar->extension();
                $file_name = Carbon::now()->timestamp . '.' . $file_extension;
                $avatar->move(public_path('uploads/avatars'), $file_name);
                $user->avatar = $file_name;
            }

            $user->save();
            return redirect()->route('admin.users')->with('status', 'Người dùng đã được cập nhật');
        } else {
            return redirect()->route('admin.users')->with('error', 'Không tìm thấy người dùng');
        }
    }

    public function user_delete($userID)
    {
        $user = User::find($userID);
        if ($user) {
            if ($user->userID === Auth::user()->userID) {
                return redirect()->route('admin.users')->with('error', 'Không thể xóa chính mình');
            }

            if (File::exists(public_path('uploads/avatars/' . $user->avatar))) {
                File::delete(public_path('uploads/avatars/' . $user->avatar));
            }
            $user->delete();
            return redirect()->route('admin.users')->with('status', 'Người dùng đã được xoá');
        } else {
            return redirect()->route('admin.users')->with('error', 'Không tìm thấy người dùng');
        }
    }
}
