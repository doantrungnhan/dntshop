@extends('admin.layouts.layout')

@section('main')
<div class="main-content-inner">

    <div class="main-content-wrap">
        <div class="tf-section mb-10"> 
            <div class="flex gap20 flex-wrap-mobile">
                <div class="w-half">

                    <div class="wg-chart-default mb-20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-shopping-bag"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Đơn hàng chờ xử lý</div>
                                    <h4>{{$ordersCount->pending_orders}} đơn</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wg-chart-default mb-20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-shopping-bag"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Đơn hàng đang xử lý</div>
                                    <h4>{{$ordersCount->processing_orders}} đơn</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
                <div class="w-half">

                    <div class="wg-chart-default mb-20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-shopping-bag"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Đơn hàng đang giao</div>
                                    <h4>{{$ordersCount->shipping_orders}} đơn</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wg-chart-default mb-20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-shopping-bag"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Đơn hàng đã giao thành công</div>
                                    <h4>{{$ordersCount->completed_orders}} đơn</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="w-half">

                    <div class="wg-chart-default mb-20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-dollar-sign"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Doanh thu hôm nay</div>
                                    <h4>{{number_price($revenue->today_revenue)}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wg-chart-default mb-20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-dollar-sign"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Doanh thu tháng này</div>
                                    <h4>{{number_price($revenue->month_revenue)}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="w-half">

                    <div class="wg-chart-default mb-20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-dollar-sign"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Doanh thu 7 ngày qua</div>
                                    <h4>{{number_price($revenue->last_7_days_revenue)}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wg-chart-default mb-20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-dollar-sign"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Doanh thu năm nay</div>
                                    <h4>{{number_price($revenue->year_revenue)}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="tf-section-2 mb-30">
            <div class="wg-box">
                <div class="flex items-center justify-between">
                    <h5>Biểu đồ doanh thu</h5>
                    <div class="dropdown default">
                        <button class="btn btn-secondary dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <span class="icon-more"><i class="icon-more-horizontal"></i></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a href="javascript:void(0);" onclick="updateChart('weekly')">7 ngày qua</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="updateChart('daily')">Tháng này</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="updateChart('monthly ')">Năm nay</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="line-chart-8"></div>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between">
                    <h5>Top sản phẩm</h5>
                    <div class="dropdown default">
                        <button class="btn btn-secondary dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <span class="icon-more"><i class="icon-more-horizontal"></i></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a href="javascript:void(0);" onclick="updateChart('weekly')">7 ngày qua</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="updateChart('daily')">Tháng này</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="updateChart('monthly ')">Năm nay</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="flex flex-wrap gap40">
                    <div>
                        <div class="mb-2">
                            <div class="block-legend">
                                <div class="dot t1"></div>
                                <div class="text-tiny">Doanh thu</div>
                            </div>
                        </div>
                        <div class="flex items-center gap10">
                            <h4>13.000.000 VNĐ</h4>
                        </div>
                    </div>
                    <div>
                        <div class="mb-2">
                            <div class="block-legend">
                                <div class="dot t2"></div>
                                <div class="text-tiny">Đơn hàng</div>
                            </div>
                        </div>
                        <div class="flex items-center gap10">
                            <h4>$28,305</h4>
                        </div>
                    </div>
                </div> -->
                <div id="line-chart-9">
                    <h3>Đợi chức năng sản phẩm</h3>
                </div>
            </div>
        </div>
         
        <div class="tf-section mb-30">

            <div class="wg-box">
                <div class="flex items-center justify-between">
                    <h5>Đơn hàng mới nhất</h5>
                    <div class="dropdown default">
                        <a class="btn btn-secondary dropdown-toggle" href="{{route('admin.order')}}">
                            <span class="view-all">Xem tất cả</span>
                        </a>
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
            </div>

        </div>
    </div>

</div>
@endsection
@push('scripts')
<script>
    // Biểu đồ cột doanh thu
    var dailyRevenue = {!!json_encode($dailyRevenue)!!};
    var weeklyRevenue = {!!json_encode($weeklyRevenue)!!};
    var monthlyRevenue = {!!json_encode($monthlyRevenue)!!};
    var dailyOrderCount = {!!json_encode($dailyOrderCount)!!};
    var weeklyOrderCount = {!!json_encode($weeklyOrderCount)!!};
    var monthlyOrderCount = {!!json_encode($monthlyOrderCount)!!};
    var currentDataType = 'monthly';
    var chart;
    function renderChart(currentData, orderCount, categories) {
        var options = {
            series: [{
                name: 'Doanh thu',
                data: currentData,
            }, {
                name: 'Đơn hàng',
                data: orderCount,
            }],
            chart: {
                type: 'bar',
                height: 325,
                toolbar: {
                    show: false,
                },
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '10px',
                    endingShape: 'rounded'
                },
            },
            xaxis: {
                labels: {
                    style: {
                        colors: '#212529',
                    },
                },
                categories: categories,
            },
            yaxis: [{
                    labels: {
                        formatter: function(val) {
                            return Intl.NumberFormat('vi-VN').format(val);
                        },
                    },
                },
                {
                    opposite: true,
                    labels: {
                        formatter: function(val) {
                            return Math.round(val);
                        },
                    },
                }
            ],
            dataLabels: {
                enabled: false,
            },
            colors: ['#2377FC', '#FFA500'],
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val, {
                        seriesIndex
                    }) {
                        // Kiểm tra chỉ số của chuỗi để xác định xem đó có phải là doanh thu hay số lượng đơn hàng
                        if (seriesIndex === 0) { // Doanh thu
                            return Intl.NumberFormat('vi-VN').format(val) + ' VNĐ';
                        } else if (seriesIndex === 1) {
                            return Math.round(val) + ' đơn';
                        }
                    }
                }

            }
        };

        if (chart) {
            chart.destroy(); // Hủy biểu đồ hiện tại nếu đã có
        }

        chart = new ApexCharts(
            document.querySelector("#line-chart-8"),
            options
        );
        chart.render();
    }
    function updateChart(filter) {
        var currentData, countOrder, categories;
        currentData = [];
        countOrder = [];
        categories = [];

        switch (filter) {
            case 'daily':
                for (var i = 1; i <= 31; i++) {
                    currentData.push(dailyRevenue[i] || 0);
                    countOrder.push(dailyOrderCount[i] || 0);
                    categories.push(i); // Các ngày từ 1 đến 31
                }
                break;
            case 'weekly':
                var currentDate = new Date();
                for (var i = 6; i >= 0; i--) {
                    var pastDate = new Date(currentDate);
                    pastDate.setDate(currentDate.getDate() - i);
                    var dateStr = pastDate.toISOString().split('T')[0];
                    currentData.push(weeklyRevenue[dateStr] || 0);
                    countOrder.push(weeklyOrderCount[dateStr] || 0);
                    categories.push(dateStr);
                }
                break;
            case 'monthly':
            default:
                for (var i = 1; i <= 12; i++) {
                    currentData.push(monthlyRevenue[i] || 0);
                    countOrder.push(monthlyOrderCount[i] || 0);
                    categories.push('Tháng ' + i); // Các tháng từ 1 đến 12
                }
                break;
        }

        renderChart(currentData, countOrder, categories);
        currentDataType = filter;
    }
    updateChart('monthly');

</script>
@endpush