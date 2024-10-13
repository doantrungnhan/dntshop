@extends('admin.layouts.layout')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Sửa Người Dùng</h3>
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
                        <div class="text-tiny">Sửa Người Dùng</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ route('admin.user.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="userID" value="{{ $user->userID }}">

                    <fieldset class="name">
                        <div class="body-title">Tên</span></div>
                        <input type="text" name="name" id="name" value="{{ $user->full_name }}"
                            class="form-control" readonly>
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title">Email</span></div>
                        <input type="text" name="email" id="email" value="{{ $user->email }}" class="form-control"
                            readonly>
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title">Số điện thoại</span></div>
                        <input type="text" name="phone" id="phone" value="{{ $user->phone }}" class="form-control"
                            readonly>
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title">Địa chỉ</span></div>
                        <input type="text" name="address" id="address" value="{{ $user->address }}"
                            class="form-control" readonly>
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title">Ngày tạo</span></div>
                        <input type="text" name="created_at" id="created_at" value="{{ $user->created_at }}"
                            class="form-control" readonly>
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title">Vai trò</span></div>
                        <select name="role" id="role" class="form-select"
                            style="height: 50px; border-radius: 10px; font-size: 14px">
                            <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Khách hàng</option>
                            <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>Admin</option>
                        </select>
                    </fieldset>

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

                    <div class="col-md-12">
                        <div class="my-3">
                            <button type="submit" class="btn btn-primary tf-button w208">Lưu</button>
                        </div>
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

{{-- @extends('admin.layouts.layout')

@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Chỉnh sửa người dùng</h3>
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
                    <div class="text-tiny">Chỉnh sửa người dùng</div>
                </li>
            </ul>
        </div>

        <div class="wg-box">
            <div class="col-lg-12">
                <div class="page-content my-account__edit">
                    <div class="my-account__edit-form">
                        <form action="{{ route('admin.user.update', $user->userID) }}" method="POST" class="form-new-product form-style-1 needs-validation" novalidate="">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="userID" value="{{ $user->userID }}">

                            <fieldset class="name">
                                <div class="body-title">Tên</span></div>
                                <input type="text" name="name" id="name" value="{{ $user->full_name }}" class="form-control" readonly>
                            </fieldset>

                            <fieldset class="name">
                                <div class="body-title">Email</span></div>
                                <input type="text" name="email" id="email" value="{{ $user->email }}" class="form-control" readonly>
                            </fieldset>

                            <fieldset class="name">
                                <div class="body-title">Số điện thoại</span></div>
                                <input type="text" name="phone" id="phone" value="{{ $user->phone }}" class="form-control" readonly>
                            </fieldset>

                            <fieldset class="name">
                                <div class="body-title">Địa chỉ</span></div>
                                <input type="text" name="address" id="address" value="{{ $user->address }}" class="form-control" readonly>
                            </fieldset>

                            <fieldset class="name">
                                <div class="body-title">Ngày tạo</span></div>
                                <input type="text" name="created_at" id="created_at" value="{{ $user->created_at }}" class="form-control" readonly>
                            </fieldset>

                            <fieldset class="name">
                                <div class="body-title">Vai trò</span></div>
                                <select name="role" id="role" class="form-select" style="height: 50px; border-radius: 10px; font-size: 14px">
                                    <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Khách hàng</option>
                                    <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>Admin</option>
                                </select>
                            </fieldset>

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
                            
                            <div class="col-md-12">
                                <div class="my-3">
                                    <button type="submit" class="btn btn-primary tf-button w208">Lưu</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
            $("#myFile").on("change", function(e) {
                const photoInp = $("#myFile");
                const [file] = this.files;

                if (file) {
                    $("#imgpreview img").attr('src', URL.createObjectURL(file));
                    $("#imgpreview").show();
                }
            });
        });
</script> --}}
