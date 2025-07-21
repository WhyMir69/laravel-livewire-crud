<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'product_code' => 'LAP001',
                'name' => 'Gaming Laptop',
                'quantity' => 15,
                'price' => 1299.99,
                'description' => 'High-performance gaming laptop with RTX 4060, 16GB RAM, and 1TB SSD. Perfect for gaming and professional work.',
                'image' => null,
            ],
            [
                'product_code' => 'PHN001',
                'name' => 'Smartphone Pro',
                'quantity' => 25,
                'price' => 899.99,
                'description' => 'Latest flagship smartphone with 128GB storage, triple camera system, and 5G connectivity.',
                'image' => null,
            ],
            [
                'product_code' => 'HDR001',
                'name' => 'Wireless Headphones',
                'quantity' => 50,
                'price' => 199.99,
                'description' => 'Premium wireless headphones with noise cancellation, 30-hour battery life, and superior sound quality.',
                'image' => null,
            ],
            [
                'product_code' => 'MON001',
                'name' => '4K Monitor',
                'quantity' => 8,
                'price' => 449.99,
                'description' => '27-inch 4K UHD monitor with HDR support, perfect for professional work and entertainment.',
                'image' => null,
            ],
            [
                'product_code' => 'KBD001',
                'name' => 'Mechanical Keyboard',
                'quantity' => 30,
                'price' => 129.99,
                'description' => 'RGB mechanical keyboard with blue switches, perfect for gaming and typing.',
                'image' => null,
            ],
            [
                'product_code' => 'MSE001',
                'name' => 'Gaming Mouse',
                'quantity' => 40,
                'price' => 79.99,
                'description' => 'High-precision gaming mouse with customizable RGB lighting and programmable buttons.',
                'image' => null,
            ],
            [
                'product_code' => 'TAB001',
                'name' => 'Tablet Pro',
                'quantity' => 12,
                'price' => 599.99,
                'description' => '11-inch tablet with Apple M2 chip, perfect for creativity and productivity.',
                'image' => null,
            ],
            [
                'product_code' => 'SPK001',
                'name' => 'Bluetooth Speaker',
                'quantity' => 35,
                'price' => 99.99,
                'description' => 'Portable Bluetooth speaker with 360-degree sound and 20-hour battery life.',
                'image' => null,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
