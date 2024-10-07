@extends('admin.layouts.layout')

@section('main')
<div class="main-content-inner">
    <style>
        .table-transaction>tbody>tr:nth-of-type(odd) {
            --bs-table-accent-bg: #fff !important;
        }
    </style>
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Thông tin đơn hàng</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{route('admin.dashboard')}}">
                        <div class="text-tiny">Bảng điều khiển</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <a href="{{route('admin.order')}}">
                        <div class="text-tiny">Danh sách đơn hàng</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Thông tin đơn hàng</div>
                </li>
            </ul>
        </div>

        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                    <h5>Mã đơn : {{$order->order_code}}</h5>
                </div>
                <a class="tf-button style-1 w208" href="{{route('admin.order')}}">Quay lại</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 400px;">Tên sản phẩm</th>
                            <th class="text-center">Giá</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-center">Mã sản phẩm</th>
                            <th class="text-center">Màu</th>
                            <th class="text-center">Size</th>
                            <th class="text-center">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderDetails as $orderDetail)
                        <tr>
                            <td class="pname">
                                <div class="image">
                                    <img src="/uploads/products/{{$orderDetail->product_variant->product->image[0]->image_url}}" alt="" class="image">
                                </div>
                                <div class="name">
                                    <a href="#" target="_blank"
                                        class="body-title-2">{{$orderDetail->product_variant->product->product_name}}</a>
                                </div>
                            </td>
                            <td class="text-center">{{number_price($orderDetail->price)}}</td>
                            <td class="text-center">{{$orderDetail->quantity}}</td>
                            <td class="text-center">{{$orderDetail->product_variant->product->product_code}}</td>
                            <td class="text-center">{{$orderDetail->product_variant->color->color_name}}</td>
                            <td class="text-center">{{$orderDetail->product_variant->size->size_name}}</td>
                            <td class="text-center">
                                <div class="list-icon-function view-icon">
                                    <div class="item eye">
                                        <i class="icon-eye"></i>
                                    </div>
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

        <div class="wg-box mt-5">
            <h5>Thông tin nhận hàng</h5>
            <div class="my-account__address-item col-md-6">
                <div class="my-account__address-item__detail">
                    <p>Họ tên người nhận: {{$order->user->full_name}}</p>
                    <br>
                    <p>Địa chỉ nhận hàng: {{$order->user->address}}</p>
                    <br>
                    <p>Số điện thoại : {{$order->user->phone}}</p>
                </div>
            </div>
        </div>

        <div class="wg-box mt-5">

            <h5>Chi tiết đơn</h5>
            <table class="table table-striped table-bordered table-transaction">
                <tbody>
                    <tr>
                        <th>Phương thức thanh toán</th>
                        <td>{{$payment_method_vn[$order->payment_method]}}</td>
                        <th>Trạng thái thanh toán</th>
                        <td>{{$payment_status_vn[$order->payment_status]}}</td>
                        <th>Trạng thái đơn hàng</th>
                        <td>{{$order_status_vn[$order->order_status]}}</td>
                    </tr>
                    <tr>
                        <th>Tổng đơn <span>(1)</span></th>
                        <td>{{number_price($order->total_amount)}}</td>
                        <th>Phiếu giảm giá <span>(2)</span></th>
                        <td>{{(isset($order->promotion_id)) ? number_price(getPromoDiscount($order->promotion->discount_type,$order->promotion->discount_value,$order->total_amount)): 0}}</td>
                        <th>Phí ship <span>(3)</span></th>
                        <td>{{number_price($order->shipping_fee)}}</td>
                    </tr>
                    <tr>
                        <th class="text-center">Tổng tiền <br> <p>(1 - 2 + 3)</p></th>
                        <td colspan="5">{{(isset($order->promotion_id)) ? number_price($order->total_amount-getPromoDiscount($order->promotion->discount_type,$order->promotion->discount_value,$order->total_amount)+$order->shipping_fee) : number_price($order->total_amount+$order->shipping_fee)}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection