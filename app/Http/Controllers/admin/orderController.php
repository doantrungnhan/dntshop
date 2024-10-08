<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Http\Request;

class orderController extends Controller
{

    private $payment_method_vn = [
        'bank_transfer' => 'Thanh toán qua ngân hàng',
        'momo' => 'Thanh toán qua ví momo',
        'cash' => 'Thanh toán khi nhận hàng',
    ];

    private $payment_status_vn = [
        'pending' => 'Chờ thanh toán',
        'completed' => 'Thanh toán thành công',
        'failed' => 'Thanh toán thất bại',
        'refunded' => 'Đã hoàn tiền',
        'paid on delivery' => 'Thanh toán khi nhận hàng'
    ];

    private $order_status_vn = [
        'pending' => 'Chờ xử lý',
        'processing' => 'Đang xử lý',
        'shipped' => 'Đang giao hàng',
        'delivered' => 'Đã giao thành công',
        'cancelled' => 'Đã hủy',
        'refunded' => 'Đã hoàn tiền'
    ];

    public function index(Request $request)
    {
        $order_status_vn = $this->order_status_vn;
        $filter = $request['filter'];
        $search = $request['search'];

        // Bắt đầu truy vấn đơn hàng
        $orders = Order::query();

        if (isset($filter)) {
            $orders->where('order_status', $filter);
        }
        
        if (isset($search)) {
            $orders->where('order_code', 'like', '%' . $search . '%');
        }

        $orders = $orders->orderBy('created_at', 'desc')->paginate(12);

        return view('admin.order.list', compact('orders', 'filter', 'order_status_vn', 'search'));
    }

    public function order_detail(Request $request, $code)
    {
        $payment_method_vn = $this->payment_method_vn;
        $payment_status_vn = $this->payment_status_vn;
        $order_status_vn = $this->order_status_vn;
        $order = Order::where('order_code', $code)->first();
        $orderDetails = Order_detail::where('order_id', $order->orderID)->get();
        return view('admin.order.detail', compact('orderDetails', 'order', 'payment_method_vn', 'payment_status_vn', 'order_status_vn'));
    }

    public function update_order_status(Request $request, $id)
    {
        $order = Order::find($id);
        $order->order_status = $request['order_status'];
        $order->save();
        return redirect()->route('admin.order')->with('success', 'Thay đổi trạng thái đơn hàng: ' . $order->order_code . ' thành công');
    }
}
