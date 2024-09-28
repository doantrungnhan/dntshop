@extends('admin.layouts.layout')

@section('main')
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
                            <input type="hidden" name="id" value="{{ $user->userID }}">

                            <fieldset class="name">
                                <div class="body-title">Tên</span></div>
                                <input type="text" name="name" id="name" value="{{ $user->full_name }}" class="form-control" readonly>
                            </fieldset>

                            <fieldset class="name">
                                <div class="body-title">Email</span></div>
                                <input type="text" name="email" id="email" value="{{ $user->email }}" class="form-control" readonly>
                            </fieldset>

                            <fieldset class="name">
                                <div class="body-title">Ngày tạo</span></div>
                                <input type="text" name="created_at" id="created_at" value="{{ $user->created_at }}" class="form-control" readonly>
                            </fieldset>

                            <fieldset class="name">
                                <div class="body-title">Vai trò</span></div>
                                <select name="customer" id="customer" class="form-select" style="height: 50px; border-radius: 10px; font-size: 14px">
                                    <option value="1" {{ $user->customer == 1 ? 'selected' : '' }}>Khách hàng</option>
                                    <option value="0" {{ $user->customer == 0 ? 'selected' : '' }}>Admin</option>
                                </select>
                            </fieldset>

                            {{-- <div class="form-group">
                                <label for="avatar">Ảnh đại diện:</label>
                                <input type="file" name="avatar" id="avatar" class="form-control" accept="image/*">
                                @if ($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" width="100">
                                @endif
                            </div> --}}

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
