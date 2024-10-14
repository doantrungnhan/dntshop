@extends('admin.layouts.layout')

@section('main')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Thêm Người Dùng</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Người dùng</div>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Thêm Người Dùng</div>
                </li>
            </ul>
        </div>

        <div class="wg-box">
            <form class="form-new-product form-style-1" action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <fieldset>
                    <div class="body-title">Tên <span class="tf-color-1">*</span></div>
                    <input type="text" name="full_name" class="flex-grow" value="{{ old('full_name') }}">
                </fieldset>
                @error('full_name')
                    <span class="alert alert-danger text-center fs-4">{{ $message }}</span>
                @enderror

                <fieldset>
                    <div class="body-title">Email <span class="tf-color-1">*</span></div>
                    <input type="email" name="email" class="flex-grow" value="{{ old('email') }}">
                </fieldset>
                @error('email')
                    <span class="alert alert-danger text-center fs-4">{{ $message }}</span>
                @enderror

                <fieldset>
                    <div class="body-title">Số điện thoại <span class="tf-color-1">*</span></div>
                    <input type="text" name="phone" class="flex-grow" value="{{ old('phone') }}">
                </fieldset>
                @error('phone')
                    <span class="alert alert-danger text-center fs-4">{{ $message }}</span>
                @enderror

                <fieldset>
                    <div class="body-title">Địa chỉ <span class="tf-color-1">*</span></div>
                    <input type="text" name="address" class="flex-grow" value="{{ old('address') }}">
                </fieldset>
                @error('address')
                    <span class="alert alert-danger text-center fs-4">{{ $message }}</span>
                @enderror

                <fieldset>
                    <div class="body-title">Mật khẩu <span class="tf-color-1">*</span></div>
                    <input type="password" name="password" class="flex-grow">
                </fieldset>
                @error('password')
                    <span class="alert alert-danger text-center fs-4">{{ $message }}</span>
                @enderror

                <fieldset>
                    <div class="body-title">Xác nhận mật khẩu <span class="tf-color-1">*</span></div>
                    <input type="password" name="password_confirmation" class="flex-grow">
                </fieldset>
                @error('password')
                    <span class="alert alert-danger text-center fs-4">{{ $message }}</span>
                @enderror

                <fieldset>
                    <div class="body-title">Vai trò <span class="tf-color-1">*</span></div>
                    <div class="select flex-grow">
                        <select name="role">
                            <option value="1" @if (old('role') == '1') selected @endif>Admin</option>
                            <option value="0" @if (old('role') == '0') selected @endif>Khách hàng</option>
                        </select>
                    </div>
                </fieldset>
                @error('role')
                    <span class="alert alert-danger text-center fs-4">{{ $message }}</span>
                @enderror

                <fieldset>
                    <div class="body-title">Ảnh đại diện</div>
                    <div class="upload-image flex-grow">
                        <div class="item" id="imgpreview" style="display: none;">
                            <img src="sample.jpg" class="effect8" alt="">
                        </div>
                        <div class="item up-load">
                            <label class="uploadfile" for="avatar">
                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>
                                <span class="body-text">Bấm vào đây để <span class="tf-color">tải ảnh lên</span></span>
                                <input type="file" id="avatar" name="avatar" accept="image/*">
                            </label>
                        </div>
                    </div>
                </fieldset>
                @error('avatar')
                    <span class="alert alert-danger text-center fs-4">{{ $message }}</span>
                @enderror

                <div class="bot">
                    <button class="tf-button w208" type="submit">Thêm Người Dùng</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#avatar").on("change", function(e) {
                const photoInp = $("#avatar");
                const [file] = this.files;

                if (file) {
                    $("#imgpreview img").attr('src', URL.createObjectURL(file));
                    $("#imgpreview").show();
                }
            });
        });
    </script>
@endpush
