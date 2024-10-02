<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Banner;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Carbon\Carbon;

class dashboardController extends Controller
{

    public function index()
    {
        return view('admin.dashboard');
    }

    // banners
    public function banners()
    {
        $banners = Banner::orderBy('bannerID', 'asc')->paginate(12);
        return view('admin.banners', compact('banners'));
    }

    public function banner_add()
    {
        return view('admin.banner-add');
    }

    public function banner_store(Request $request)
    {
        $request->validate([
            'position' => 'required',
            'hidden' => 'required|in:0,1',
            'image_url' => 'required|mimes:jpeg,jpg,png|max:2048'
        ], [
            'position.required' => 'Vị trí không được để trống.',
            'hidden.required'  => 'Trạng thái không được để trống.',
            'hidden.in' => 'Trạng thái không hợp lệ.',
            'image_url.required' => 'Hình ảnh không được để trống.',
            'image_url.mimes' => 'Hình ảnh phải có định dạng: jpeg, jpg, png.',
            'image_url.max' => 'Hình ảnh không được vượt quá 2MB.'
        ]);

        $banner = new Banner();
        $banner->position = $request->position;
        $banner->hidden = $request->hidden;

        $image_url = $request->file('image_url');
        $file_extension = $request->file('image_url')->extension();
        $file_name = Carbon::now()->timestamp . '.' . $file_extension;
        $this->GenerateBannerThumbnailsImage($image_url, $file_name);
        $banner->image_url = $file_name;
        $banner->save();

        return redirect()->route('admin.banners')->with('status', 'Banner đã được thêm');
    }

    public function GenerateBannerThumbnailsImage($image_url, $imageName)
    {
        $destinationPath = public_path('uploads/banners');
        $img = Image::read($image_url->path());
        // $img->cover(400, 690, "top");
        // $img->resize(400, 690, function ($constraint) {
        //     $constraint->aspectRatio();
        // })->save($destinationPath . '/' . $imageName);
        $img->save($destinationPath . '/' . $imageName);
    }



    public function banner_edit($bannerID)
    {
        $banner = Banner::find($bannerID);
        return view('admin.banner-edit', compact('banner'));
    }

    public function banner_update(Request $request)
    {
        $request->validate([
            'position' => 'required',
            'hidden' => 'required',
            'image_url' => 'required|mimes:jpeg,jpg,png|max:2048'
        ]);

        $banner = Banner::find($request->bannerID);
        $banner->position = $request->position;
        $banner->hidden = $request->hidden;

        if ($request->hasFile('image_url')) {
            if (File::exists(public_path('uploads/banners') . '/' . $banner->image_url)) {
                File::delete(public_path('uploads/banners') . '/' . $banner->image_url);
            }
            $image = $request->file('image_url');
            $file_extension = $request->file('image_url')->extension();
            $file_name = Carbon::now()->timestamp . '.' . $file_extension;
            $this->GenerateBannerThumbnailsImage($image, $file_name);
            $banner->image_url = $file_name;
        }

        $banner->save();
        return redirect()->route('admin.banners')->with('status', 'Banner đã được cập nhật');
    }

    public function banner_delete($bannerID)
    {
        $banner = Banner::find($bannerID);
        if (File::exists(public_path('uploads/banners') . '/' . $banner->image_url)) {
            File::delete(public_path('uploads/banners') . '/' . $banner->image_url);
        }
        $banner->delete();
        return redirect()->route('admin.banners')->with('status', 'Banner đã được xoá');
    }

    // users
    public function users()
    {
        $users = User::orderBy('userID', 'asc')->paginate(12);
        return view('admin.users', compact('users'));
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
            'role' => 'required|in:0,1',
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
        $user->delete();
        return redirect()->route('admin.users')->with('status', 'Người dùng đã được xoá');
    }
}
