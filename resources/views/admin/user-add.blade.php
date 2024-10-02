@extends('admin.layouts.layout')

@section('main')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Thêm Người Dùng</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <div class="text-tiny">Bảng điều khiển</div>
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
            <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <fieldset>
                    <div class="body-title">Tên <span class="tf-color-1">*</span></div>
                    <input type="text" name="full_name" class="flex-grow" required value="{{ old('full_name') }}">
                </fieldset>
                @error('full_name')
                    <span class="alert alert-danger text-center">{{ $message }}</span>
                @enderror

                <fieldset>
                    <div class="body-title">Email <span class="tf-color-1">*</span></div>
                    <input type="email" name="email" class="flex-grow" required value="{{ old('email') }}">
                </fieldset>
                @error('email')
                    <span class="alert alert-danger text-center">{{ $message }}</span>
                @enderror

                <fieldset>
                    <div class="body-title">Mật khẩu <span class="tf-color-1">*</span></div>
                    <input type="password" name="password" class="flex-grow" required>
                </fieldset>
                @error('password')
                    <span class="alert alert-danger text-center">{{ $message }}</span>
                @enderror

                <fieldset>
                    <div class="body-title">Xác nhận mật khẩu <span class="tf-color-1">*</span></div>
                    <input type="password" name="password-confirm" class="flex-grow" required>
                </fieldset>
                @error('password')
                    <span class="alert alert-danger text-center">{{ $message }}</span>
                @enderror

                <fieldset>
                    <div class="body-title">Vai trò <span class="tf-color-1">*</span></div>
                    <div class="select flex-grow">
                        <select name="customer" required>
                            <option value="1" @if (old('customer') == '1') selected @endif>Khách hàng</option>
                            <option value="0" @if (old('customer') == '0') selected @endif>Admin</option>
                        </select>
                    </div>
                </fieldset>
                @error('customer')
                    <span class="alert alert-danger text-center">{{ $message }}</span>
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
                    <span class="alert alert-danger text-center">{{ $message }}</span>
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
