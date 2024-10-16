<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Banner;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Carbon\Carbon;

class dashboardController extends Controller
{

    public function index()
    {
        // Đếm só lượng đơn hàng
        $ordersCount = Order::selectRaw('
                COUNT(CASE WHEN order_status = "pending" THEN 1 END) AS pending_orders,
                COUNT(CASE WHEN order_status = "processing" THEN 1 END) AS processing_orders,
                COUNT(CASE WHEN order_status = "shipped" THEN 1 END) AS shipping_orders,
                COUNT(CASE WHEN order_status = "delivered" THEN 1 END) AS completed_orders
            ')
            ->first();

        // Lấy doanh thu 
        $revenue = Order::selectRaw('
                SUM(CASE WHEN order_status = "delivered" AND DATE(created_at) = CURDATE() THEN total_amount ELSE 0 END) AS today_revenue,
                SUM(CASE WHEN order_status = "delivered" AND created_at >= CURDATE() - INTERVAL 7 DAY THEN total_amount ELSE 0 END) AS last_7_days_revenue,
                SUM(CASE WHEN order_status = "delivered" AND MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE()) THEN total_amount ELSE 0 END) AS month_revenue,
                SUM(CASE WHEN order_status = "delivered" AND YEAR(created_at) = YEAR(CURDATE()) THEN total_amount ELSE 0 END) AS year_revenue
            ')
            ->first();
        
        $current = Carbon::now()->endOfDay(); // Khởi tạo thông tin thời gian thực
        $time7Day = Carbon::now()->subDays(6);
        // Lấy dữ liệu tất cả các ngày trong tháng
        $dailyRevenue = Order::selectRaw('SUM(total_amount ) as total, DAY(created_at) as day')
            ->whereYear('created_at', $current->year)
            ->whereMonth('created_at', $current->month)
            ->where('order_status', 'delivered')
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('total', 'day')
            ->toArray();

        // Lấy dữ liệu 7 ngày vừa qua
        $weeklyRevenue = Order::selectRaw('SUM(total_amount ) as total, DATE(created_at) as date')
            ->whereBetween('created_at', [$time7Day, $current])
            ->where('order_status', 'delivered')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('total', 'date')
            ->toArray();

        // Lấy dữ liệu các tháng trong năm
        $monthlyRevenue = Order::selectRaw('SUM(total_amount ) as total, MONTH(created_at) as month')
            ->whereYear('created_at', $current->year)
            ->where('order_status', 'delivered')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Lấy số lượng đơn hàng trong tháng
        $dailyOrderCount = Order::selectRaw('Count(*) as quantity, DAY(created_at) as day')
            ->whereYear('created_at', $current->year)
            ->whereMonth('created_at', $current->month)
            ->where('order_status', 'delivered')
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('quantity', 'day')
            ->toArray();

        // Lấy số lượng đơn hàng trong 7 ngày vừa qua
        $weeklyOrderCount = Order::selectRaw('Count(*) as quantity, DATE(created_at) as date')
            ->whereBetween('created_at', [$time7Day, $current])
            ->where('order_status', 'delivered')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('quantity', 'date')
            ->toArray();

        // Lấy đơn hàng các tháng trong năm
        $monthlyOrderCount = Order::selectRaw('Count(*) as quantity, MONTH(created_at) as month')
            ->whereYear('created_at', $current->year)
            ->where('order_status', 'delivered')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('quantity', 'month')
            ->toArray();

        $orders = Order::take(5)->get();
        // dd($weeklyOrderCount,$weeklyRevenue,$time7Day);
        return view('admin.dashboard', [
            'ordersCount' => $ordersCount,
            'revenue' => $revenue,
            'dailyRevenue' => $dailyRevenue,
            'weeklyRevenue' => $weeklyRevenue,
            'monthlyRevenue' => $monthlyRevenue,
            'dailyOrderCount' => $dailyOrderCount,
            'weeklyOrderCount' => $weeklyOrderCount,
            'monthlyOrderCount' => $monthlyOrderCount,

            'orders' => $orders
        ]);
    }
}
