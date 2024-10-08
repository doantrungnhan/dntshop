@extends('admin.layouts.layout')

@section('main')
<div class="main-content-wrap">
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Danh mục</h3>
        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
            <li>
                <a href="index.html">
                    <div class="text-tiny">Bảng điều khiển</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <div class="text-tiny">Danh mục</div>
            </li>
        </ul>
    </div>

    <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap">
            <div class="wg-filter flex-grow">
                <form class="form-search">
                    <fieldset class="name">
                        <input type="text" placeholder="Tìm kiếm danh mục..." class="" name="name"
                            tabindex="2" value="" aria-required="true" required="">
                    </fieldset>
                    <div class="button-submit">
                        <button class="" type="submit"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>
            <a class="tf-button style-1 w208" href="add-category.html"><i
                    class="icon-plus"></i>Thêm mới</a>
        </div>
        <div class="wg-table table-all-user">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên danh mục</th>
                        <th>Đường dẫn</th>
                        <th>Mô tả</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)

                    <tr>
                        <td>{{$category->categoryID}}</td>
                        <td class="pname">
                            <div class="image">
                                <img src="/Images/categories/{{$category->image}}" alt="" class="image">
                            </div>
                            <div class="name">
                                <a href="#" class="body-title-2">{{$category->category_name}}</a>
                            </div>
                        </td>
                        <td><a href="#" target="_blank">{{$category->slug}}</a></td>
                        <td>{{$category->description}}</td>
                        <td>
                            <div class="list-icon-function">
                                <a href="#" >
                                    <div class="item edit">
                                        <i class="icon-edit-3"></i>
                                    </div>
                                </a>
                                <form action="/admin/category/{{$category->categoryID}}" method="POST" id="delete">
                                    @csrf
                                    @method('DELETE')
                                    <div class="item text-danger delete" onclick="event.preventDefault; document.getElementById('delete').submit()">
                                        <i class="icon-trash-2" ></i>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="divider"></div>
        <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

        </div>
    </div>
</div>

@endsection
