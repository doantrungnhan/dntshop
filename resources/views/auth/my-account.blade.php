@extends('layouts.layout')

@section('main')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">Tài khoản của tôi</h2>
        <div class="row">
            <div class="col-lg-3">
                <ul class="account-nav">
                    <li><a href="{{route('account')}}" class="menu-link menu-link_us-s menu-link_active">Bảng điều khiển</a></li>
                    @if(Auth::user()->isAdmin())
                    <li><a href="{{route('admin.dashboard')}}" class="menu-link menu-link_us-s">Quản trị viên</a></li>
                    @endif
                    <li><a href="account-orders.html" class="menu-link menu-link_us-s">Đơn hàng</a></li>
                    <!-- <li><a href="account-address.html" class="menu-link menu-link_us-s">Addresses</a></li> -->
                    <li><a href="account-details.html" class="menu-link menu-link_us-s">Thông tin tài khoản</a></li>
                    <li><a href="account-wishlist.html" class="menu-link menu-link_us-s">Danh sách yêu thích</a></li>
                    <li><p class="menu-link menu-link_us-s" style="cursor:pointer ;" onclick="event.defaultPrevented;document.getElementById('logout').submit()">Đăng xuất</p></li>

                    <form action="{{route('logout')}}" method="post" hidden id="logout">
                        @csrf
                    </form>
                </ul>
            </div>
            <div class="col-lg-9">
                <div class="page-content my-account__dashboard">
                    <p>Xin chào <strong>{{auth()->user()->full_name}}</strong></p>
                    <p>Từ bảng điều khiển tài khoản, bạn có thể xem các đơn hàng gần đây , quản lý địa chỉ giao hàng và chỉnh sửa mật khẩu cũng như thông tin tài khoản.</p>
                    <!-- <p>From your account dashboard you can view your <a class="unerline-link" href="account_orders.html">recent
                            orders</a>, manage your <a class="unerline-link" href="account_edit_address.html">shipping
                            addresses</a>, and <a class="unerline-link" href="account_edit.html">edit your password and account
                            details.</a></p> -->
                </div>
            </div>
        </div>
    </section>
</main>
@endsection