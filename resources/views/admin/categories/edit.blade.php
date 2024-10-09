@extends('admin.layouts.layout')
@section('main')
<div class="main-content-inner">
    <!-- main-content-wrap -->
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Sửa danh mục</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{route('admin.dashboard')}}">
                        <div class="text-tiny">Bảng điều khiển</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <a href="{{route('admin.categories')}}">
                        <div class="text-tiny">Danh mục</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Danh mục mới</div>
                </li>
            </ul>
        </div>
        <!-- new-category -->
        <div class="wg-box">
            <form class="form-new-product form-style-1" action="{{route('admin.categories.update',['categoriesID'=> $categories->categoryID])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method ('PUT')
                <fieldset class="name">
                    <div class="body-title">Tên danh mục <span class="tf-color-1">*</span>
                    </div>
                    <input class="flex-grow" type="text" placeholder="Tên danh mục" name="category_name"
                        tabindex="0" value="{{$categories->category_name}}" aria-required="true" required="">
                </fieldset>
                <fieldset class="name">
                    <div class="body-title">Mô tả <span class="tf-color-1">*</span>
                    </div>
                    <textarea class="flex-grow" type="text" placeholder="Mô tả" name="description"
                        tabindex="0" value="" aria-required="true" required="">{{$categories->description}}</textarea>
                </fieldset>
                <fieldset class="image">

                    <img src="/uploads/categories/{{$categories->image}}" alt="" class="image flex-grow">
                </fieldset>
                <fieldset>
                    <div class="body-title">Tải ảnh lên <span class="tf-color-1">*</span>
                    </div>
                    <div class="upload-image flex-grow">
                        <div class="item" id="imgpreview" style="display:none">
                            <img src="upload-1.html" class="effect8" alt="">
                        </div>
                        <div id="upload-file" class="item up-load">
                            <label class="uploadfile" for="myFile">
                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>
                                <span class="body-text">Thả hình ảnh của bạn ở đây hoặc chọn <span
                                        class="tf-color">nhấp để duyệt</span></span>
                                <input type="file" id="myFile" name="up_image" accept="image/*">
                            </label>
                        </div>
                    </div>
                </fieldset>
                <div class="bot">
                    <div></div>
                    <button class="tf-button w208" type="submit">Sửa</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
