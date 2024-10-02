@extends('admin.layouts.layout')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Sửa Banner</h3>
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
                        <div class="text-tiny">Sửa Banner</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ route('admin.banner.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="bannerID" value="{{ $banner->bannerID }}">
                    <fieldset class="name">
                        <div class="body-title">Vị trí <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Vị trí banner" name="position"
                            tabindex="0" value="{{ $banner->position }}" required>
                    </fieldset>
                    @error('position')
                        <span class="alert alert-danger text-center">{{ $message }}</span>
                    @enderror

                    <fieldset class="category">
                        <div class="body-title">Trạng thái <span class="tf-color-1">*</span></div>
                        <div class="select flex-grow">
                            <select name="hidden" required>
                                <option value="1" @if ($banner->hidden == '1') selected @endif>Ẩn</option>
                                <option value="0" @if ($banner->hidden == '0') selected @endif>Hiện</option>
                            </select>
                        </div>
                    </fieldset>
                    @error('hidden')
                        <span class="alert alert-danger text-center">{{ $message }}</span>
                    @enderror

                    <fieldset>
                        <div class="body-title">Tải hình ảnh <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image flex-grow">
                            @if ($banner->image_url)
                            <div class="item" id="imgpreview">
                                <img src="{{ asset('uploads/banners') }}/{{ $banner->image_url }}" class="effect8" alt="">
                            </div>
                            @endif
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
                        <span class="alert alert-danger text-center">{{ $message }}</span>
                    @enderror

                    <div class="bot">
                        <button class="tf-button w208" type="submit">Cập nhật</button>
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
