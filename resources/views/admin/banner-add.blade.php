@extends('admin.layouts.layout')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Thêm Banner</h3>
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
                        <a href="{{ route('admin.banner.add') }}">
                            <div class="text-tiny">Banners</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Thêm Banner</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ route('admin.banner.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <fieldset class="name">
                        <div class="body-title">Vị trí <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Vị trí banner" name="position"
                            tabindex="0" value="{{ old('position') }}" >
                    </fieldset>
                    @error('position')
                        <span class="alert alert-danger text-center fs-4">{{ $message }}</span>
                        {{-- <span class="text-danger font-weight-bold text-center" style="font-size: 16px;">{{ $message }}</span> --}}
                    @enderror

                    <fieldset class="category">
                        <div class="body-title">Trạng thái <span class="tf-color-1">*</span></div>
                        <div class="select flex-grow">
                            <select name="hidden" required>
                                <option value="1" @if (old('status') == '1') selected @endif>Ẩn</option>
                                <option value="0" @if (old('status') == '0') selected @endif>Hiện</option>
                            </select>
                        </div>
                    </fieldset>
                    @error('hidden')
                        <span class="alert alert-danger text-center fs-4">{{ $message }}</span>
                    @enderror

                    <fieldset>
                        <div class="body-title">Tải hình ảnh <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image flex-grow">
                            <div class="item" id="imgpreview" style="display: none;">
                                <img src="sample.jpg" class="effect8" alt="">
                            </div>
                            <div class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Bấm vào đây để <span class="tf-color">tải ảnh lên</span></span>
                                    <input type="file" id="myFile" name="image_url">
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    @error('image_url')
                        <span class="alert alert-danger text-center fs-4">{{ $message }}</span>
                    @enderror

                    <div class="bot">
                        <button class="tf-button w208" type="submit">Thêm</button>
                    </div>
                </form>
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
    </script>
@endpush
