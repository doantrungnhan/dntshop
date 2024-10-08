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
                'promotion_id' => 1
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
    }
}
