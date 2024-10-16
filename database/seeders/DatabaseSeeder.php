<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Product_color;
use App\Models\Product_image;
use App\Models\Product_size;
use App\Models\Product_variant;
use App\Models\Promotion;
use App\Models\User;
use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::insert([
            'full_name' => 'Đoàn trung Nhân',
            'email' => 'doantrungnhan24@gmail.com',
            'address' => 'K07/77 Phan Van Dinh, Da Nang',
            'role' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'phone' => '0328652467',
            'password' => bcrypt('nhan2004'),
            'avatar' => 'doantrungnhan_avatar.jpg'
        ]);

        Categories::insert([
            ['category_name' => 'Áo', 'slug' => 'ao'],
            ['category_name' => 'Quần', 'slug' => 'quan']
        ]);

        Product::insert([
            [
                'product_code' => 'AO001',
                'product_name' => 'Áo polo nam tính quyến dũ',
                'slug' => 'ao-polo-nam-tinh-quyen-du',
                'price' => 500000,
                'category_id' => 1,
            ],
            [
                'product_code' => 'QUAN001',
                'product_name' => 'Quần nam quyến dũ',
                'slug' => 'ao-polo-nam-quyen-du',
                'price' => 300000,
                'category_id' => 2,
            ],
        ]);

        Product_size::insert([
            ['size_name' => 'S'],
            ['size_name' => 'M'],
            ['size_name' => 'L'],
            ['size_name' => 'XL'],
            ['size_name' => 'XXL'],
            ['size_name' => 'XXXL'],
            ['size_name' => 'XXXXL'],
        ]);

        Product_color::insert([
            ['color_name' => 'Trắng'],
            ['color_name' => 'Đen'],
            ['color_name' => 'Vàng'],
            ['color_name' => 'Tím'],
            ['color_name' => 'Xanh dương'],
        ]);


        Product_image::insert([
            [
                'image_url' => 'Ao-polo-01.webp',
                'product_id' => 1,
            ],
            [
                'image_url' => 'Ao-polo-02.webp',
                'product_id' => 1,
            ],
            [
                'image_url' => 'Ao-polo-03.webp',
                'product_id' => 1,
            ],
            [
                'image_url' => 'Quan-01.webp',
                'product_id' => 2,
            ],
            [
                'image_url' => 'Quan-02.jpg',
                'product_id' => 2,
            ],
            [
                'image_url' => 'Quan-03.jpg',
                'product_id' => 2,
            ],
        ]);


        Product_variant::insert([
            [
                'product_id' => 1,
                'size_id' => 1,
                'color_id' => 1,
                'quantity' => 100
            ],
            [
                'product_id' => 1,
                'size_id' => 2,
                'color_id' => 1,
                'quantity' => 100
            ],
            [
                'product_id' => 1,
                'size_id' => 3,
                'color_id' => 1,
                'quantity' => 100
            ],
            [
                'product_id' => 2,
                'size_id' => 1,
                'color_id' => 2,
                'quantity' => 100
            ],
            [
                'product_id' => 1,
                'size_id' => 2,
                'color_id' => 2,
                'quantity' => 100
            ],
            [
                'product_id' => 1,
                'size_id' => 3,
                'color_id' => 2,
                'quantity' => 100
            ],
        ]);

        Promotion::insert([
            [
                'code' => "KM001",
                'discount_type' => 'fixed',
                'discount_value' => 100000,
            ],
            [
                'code' => "KM002",
                'discount_type' => 'percentage',
                'discount_value' => 30,
            ],
        ]);

        Order::insert([
            [
                'order_code' => 'ODNT001',
                'total_amount' => '1300000',
                'payment_method' => 'momo',
                'shipping_fee'=> 30000,
                'payment_status' => 'pending',
                'order_status' => 'pending',
                'user_id' => 1,
                'promotion_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Order_detail::insert([
            [
                'variant_id' => 1, 
                'order_id' => 1,
                'quantity' => 2,
                'price' => 500000,
            ],
            [
                'variant_id' => 2, 
                'order_id' => 1,
                'quantity' => 1,
                'price' => 300000,
            ],
        ]);


        for ($i = 2; $i <= 11; $i++) {
            $orderCode = 'ODNT' . Str::padLeft($i, 3, '0');
            
            // Tạo đơn hàng
            Order::insert([
                'order_code' => $orderCode,
                'total_amount' => rand(500000, 3000000), // Giá trị đơn hàng ngẫu nhiên
                'payment_method' => collect(['cash', 'bank_transfer', 'momo'])->random(),
                'shipping_fee' => rand(20000, 50000),
                'payment_status' => collect(['pending', 'completed', 'failed', 'paid on delivery'])->random(),
                'order_status' => collect(['pending', 'processing', 'shipped', 'delivered', 'cancelled'])->random(),
                'user_id' => 1,
                'promotion_id' => rand(1, 2), // Áp dụng mã khuyến mãi ngẫu nhiên
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Tạo chi tiết đơn hàng cho mỗi đơn
            $variantId = rand(1, 6); // Lấy biến thể ngẫu nhiên từ các sản phẩm đã seed
            $quantity = rand(1, 5);  // Số lượng sản phẩm ngẫu nhiên
            $price = rand(100000, 500000); // Giá sản phẩm ngẫu nhiên

            Order_detail::insert([
                'variant_id' => $variantId,
                'order_id' => $i,
                'quantity' => $quantity,
                'price' => $price,
            ]);

            // Tạo thêm chi tiết sản phẩm thứ 2 cho đơn hàng ngẫu nhiên
            if (rand(0, 1)) { // 50% cơ hội để có chi tiết sản phẩm thứ 2
                $variantId2 = rand(1, 6);
                $quantity2 = rand(1, 3);
                $price2 = rand(100000, 500000);

                Order_detail::insert([
                    'variant_id' => $variantId2,
                    'order_id' => $i,
                    'quantity' => $quantity2,
                    'price' => $price2,
                ]);
            }
        }
    }
}
