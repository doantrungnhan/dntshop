<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\File;
// use Intervention\Image\Facades\Image;
use Intervention\Image\Laravel\Facades\Image;
use Carbon\Carbon;

class BannerController extends Controller
{
    // banners
    public function banners(Request $request)
    {
        $search = $request->input('name');
        
        if ($search) {
            $banners = Banner::where('position', 'like', '%' . $search . '%')
                ->orWhere('hidden', 'like', '%' . $search . '%')
                ->orderBy('bannerID', 'asc')
                ->paginate(10);
        } else {
            $banners = Banner::orderBy('bannerID', 'asc')->paginate(10);
        }
        

        return view('admin.banners', compact('banners', 'search'));
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
        ],[
            'position.required' => 'Vị trí không được để trống.',
            'hidden.required'  => 'Trạng thái không được để trống.',
            'hidden.in' => 'Trạng thái không hợp lệ.',
            'image_url.required' => 'Hình ảnh không được để trống.',
            'image_url.mimes' => 'Hình ảnh phải có định dạng: jpeg, jpg, png.',
            'image_url.max' => 'Hình ảnh không được vượt quá 2MB.'
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
}
