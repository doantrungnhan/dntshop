@extends('admin.layouts.layout')

@section('main')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Danh sách đơn hàng</h3>
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
                    <div class="text-tiny">Danh sách đơn hàng</div>
                </li>
            </ul>
        </div>

        <div class="wg-box">
            <div class="flex items-center justify-between flex-wrap">
                <div class="wg-filter flex-grow">
                    <form class="form-search" action="{{route('admin.order')}}" method="get">
                        <fieldset class="name">
                            <input type="text" placeholder="Tìm kiếm đơn hàng theo mã" class="" name="search"
                                tabindex="2" value="{{$search}}" aria-required="true" required="">
                        </fieldset>
                        <div class="button-submit">
                            <button class="" type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="wg-filter">
                    <form class="form-new-product" method="get" action="{{ route('admin.order')}}">
                        <fieldset class="select flex-grow">
                            <select name="filter" id="" class="" onchange="this.form.submit()">
                                <option disabled selected>Bộ lọc</option>
                                <option value="pending" {{ ($filter=='pending') ? 'selected' : ''}}>Đơn hàng chờ xử lý</option>
                                <option value="processing" {{ ($filter=='processing') ? 'selected' : ''}}>Đơn hàng đang xử lý</option>
                                <option value="shipped" {{ ($filter=='shipped') ? 'selected' : ''}}>Đơn hàng đang giao</option>
                                <option value="delivered" {{ ($filter=='delivered') ? 'selected' : ''}}>Đơn hàng đã hoàn thành</option>
                                <option value="cancelled" {{ ($filter=='cancelled') ? 'selected' : ''}}>Đơn hàng đã hủy</option>
                                <option value="refunded" {{ ($filter=='refunded') ? 'selected' : ''}}>Đơn hàng đã hoàn tiền</option>
                            </select>
                        </fieldset>
                    </form>
                </div>
            </div>

            <div class="wg-table table-all-user">
                <div class="table-responsive">
                    @if($orders->isEmpty())
                        <p class="text-center">Không tìm thấy đơn hàng nào</p>
                    @else
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width:100px" class="text-center">Mã đơn hàng</th>
                                <th style="width:200px" class="text-center">Người đặt đơn</th>
                                <th class="text-center">Số điện thoại</th>
                                <th class="text-center">Địa chỉ nhận hàng</th>
                                <th class="text-center">Tổng tiền <br>
                                    <p>(Tổng hóa đơn)</p>
                                </th>
                                {{-- <th class="text-center">Tổng số sản phẩm</th> --}}
                                <th class="text-center">Thời gian đặt đơn</th>
                                <th class="text-center" style="width: 220px;">Trạng thái đơn hàng</th>
                                <th class="text-center" style="width: 100px;">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td class="text-center">{{$order->order_code}}</td>
                                <td class="text-center">{{$order->user->full_name}}</td>
                                <td class="text-center">{{$order->user->phone}}</td>
                                <td class="text-center">{{$order->user->address}}</td>
                                <td class="text-center">{{(isset($order->promotion_id)) ? number_price($order->total_amount-getPromoDiscount($order->promotion->discount_type,$order->promotion->discount_value,$order->total_amount)+$order->shipping_fee) : number_price($order->total_amount+$order->shipping_fee)}}</td>
                                {{-- <td class="text-center">{{$order->order_detail->count()}}</td> --}}
                                <td class="text-center">{{$order->created_at->format('d/m/Y H:i:s')}}</td>
                                <td class="">
                                        <form class="select" action="{{route('admin.order.status',['id' => $order->orderID]) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select name="order_status" onchange="this.form.submit()" class="" style="border:none;">
                                                <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Đang chờ xử lý</option>
                                                <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                                                <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Đang giao hàng</option>
                                                <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Giao hàng thành công</option>
                                                <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                                <option value="refunded" {{ $order->order_status == 'refunded' ? 'selected' : '' }}>Đã hoàn tiền</option>
                                            </select>
                                        </form>
                                    </td>   
                                
                                <td class="text-center">
                                    <a href="{{route('admin.order.detail',['code'=> strtolower($order->order_code)])}}">
                                        <div class="list-icon-function view-icon">
                                            <div class="item eye">
                                                <i class="icon-eye"></i>
                                            </div>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
            {{ $orders->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection