@extends('admin.layouts.layout')

@section('main')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Thông tin tags</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="#">
                            <div class="text-tiny">Bảng điều khiển</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <div class="text-tiny">Tags</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Cập Nhật Tags</div>
                    </li>
                </ul>
            </div>
            <!-- new-category -->
            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{route('tag.update',$tag->tagID)}}" method="POST">
                @csrf
                    <fieldset class="name">
                        <div class="body-title">Tên Tags <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Tên tags" name="name"
                            tabindex="0" value="{{$tag->tag_name}}" aria-required="true" required="">
                    </fieldset>

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection