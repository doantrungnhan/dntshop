<div class="section-menu-left">
    <div class="box-logo">
        <a href="/" id="site-logo-inner">
            <img class="" id="logo_header" alt="" src="images/logo/logo.png"
                data-light="images/logo/logo.png" data-dark="images/logo/logo.png">
        </a>
        <div class="button-show-hide">
            <i class="icon-menu-left"></i>
        </div>
    </div>
    <div class="center">
        <div class="center-item">
            <div class="center-heading">Trang chủ</div>
            <ul class="menu-list">
                <li class="menu-item">
                    <a href="{{route('admin.dashboard')}}" class="">
                        <div class="icon"><i class="icon-grid"></i></div>
                        <div class="text">Bảng điều khiển</div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="center-item">
            <div class="center-heading">Quản trị</div>
            <ul class="menu-list">
                <li class="menu-item has-children">
                    <a href="javascript:void(0);" class="menu-item-button">
                        <div class="icon"><i class="icon-user"></i></div>
                        <div class="text">Người dùng</div>
                    </a>
                    <ul class="sub-menu">
                        <li class="sub-menu-item">
                            <a href="{{route('admin.user.add')}}" class="">
                                <div class="text">Thêm mới</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="{{route('admin.users') }}" class="">
                                <div class="text">Danh sách</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item has-children">
                    <a href="javascript:void(0);" class="menu-item-button">
                        <div class="icon"><i class="icon-layers"></i></div>
                        <div class="text">Banner</div>
                    </a>
                    <ul class="sub-menu">
                        <li class="sub-menu-item">
                            <a href="{{route('admin.banner.add')}}" class="">
                                <div class="text">Thêm mới</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="{{route('admin.banners') }}" class="">
                                <div class="text">Danh sách</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item has-children">
                    <a href="javascript:void(0);" class="menu-item-button">
                        <div class="icon"><i class="icon-file-plus"></i></div>
                        <div class="text">Thẻ bài viết</div>
                    </a>
                    <ul class="sub-menu">
                        <li class="sub-menu-item">
                            <a href="{{route('tag.create')}}" class="">
                                <div class="text">Thêm mới</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="{{route('tag')}}" class="">
                                <div class="text">Liệt kê</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item has-children">
                    <a href="javascript:void(0);" class="menu-item-button">
                        <div class="icon"><i class="icon-layers"></i></div>
                        <div class="text">Danh mục</div>
                    </a>
                    <ul class="sub-menu">
                        <li class="sub-menu-item">
                            <a href="{{route('admin.categories.add')}}" class="">
                                <div class="text">Thêm mới</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="{{route('admin.categories') }}" class="">
                                <div class="text">Danh sách</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item has-children">
                    <a href="javascript:void(0);" class="menu-item-button">
                        <div class="icon"><i class="icon-shopping-cart"></i></div>
                        <div class="text">Sản phẩm</div>
                    </a>
                    <ul class="sub-menu">
                        <li class="sub-menu-item">
                            <a href="{{route('admin.banners')}}" class="">
                                <div class="text">Thêm mới</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="{{route('admin.banner.add') }}" class="">
                                <div class="text">Danh sách</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item {{Route::currentRouteName() === 'admin.order' ? 'active' : ''}}">
                    <a href="{{route('admin.order')}}" class="">
                        <div class="icon"><i class="icon-grid"></i></div>
                        <div class="text">Đơn hàng</div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
