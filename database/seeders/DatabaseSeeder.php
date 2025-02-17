<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use DB;
use Schema;
use Illuminate\Database\Seeder;

// php artisan db:seed --class=DatabaseSeeder

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('categories')->truncate();
        DB::table('products')->truncate();
        DB::table('sales')->truncate();
        DB::table('salesDetail')->truncate();
        DB::table('stockHistory')->truncate();
        Schema::enableForeignKeyConstraints();
        
        // Insert sample data
        // date('Y-m-d H:i:s', strtotime('-5 days'));
        DB::table('categories')->insert([
            [
                'name' => 'Drink', 
                'created_at' => now()->subDay(), 
                'updated_at' => now()->subDay()
            ],
            [
                'name' => 'Food', 
                'created_at' => now()->subDay(), 
                'updated_at' => now()->subDay()
            ],
            [
                'name' => 'Technology', 
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Pharmacy', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'name' => 'Stationary', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
        ]);

        DB::table('products')->insert([
            [
                'productName' => 'Coca Cola',
                'price' => 70,
                'category_id' => 1,
                'stockQuantity' => 200,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'productName' => 'Fanta',
                'price' => 70,
                'category_id' => 1,
                'stockQuantity' => 200,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'productName' => 'Sprite',
                'price' => 70,
                'category_id' => 1,
                'stockQuantity' => 200,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'productName' => 'Pepsi Cola',
                'price' => 65,
                'category_id' => 1,
                'stockQuantity' => 180,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'productName' => 'Mirinda',
                'price' => 65,
                'category_id' => 1,
                'stockQuantity' => 180,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'productName' => '7 UP',
                'price' => 65,
                'category_id' => 1,
                'stockQuantity' => 180,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'productName' => 'Cake',
                'price' => 130,
                'category_id' => 2,
                'stockQuantity' => 20,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'productName' => 'Bread',
                'price' => 110,
                'category_id' => 2,
                'stockQuantity' => 60,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'productName' => 'Banana',
                'price' => 230,
                'category_id' => 2,
                'stockQuantity' => 60,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'productName' => 'Cheese Burger',
                'price' => 1130,
                'category_id' => 2,
                'stockQuantity' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'productName' => 'HP Envy',
                'price' => 81200,
                'category_id' => 3,
                'stockQuantity' => 37,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'productName' => 'Samsung A15',
                'price' => 17000,
                'category_id' => 3,
                'stockQuantity' => 75,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'productName' => 'Sony WH-CH520',
                'price' => 4400,
                'category_id' => 3,
                'stockQuantity' => 168,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'productName' => 'Panadol',
                'price' => 200,
                'category_id' => 4,
                'stockQuantity' => 360,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'productName' => 'Zefcolin',
                'price' => 440,
                'category_id' => 4,
                'stockQuantity' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'productName' => 'Pencil x6',
                'price' => 120,
                'category_id' => 5,
                'stockQuantity' => 680,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'productName' => 'Pen x6',
                'price' => 200,
                'category_id' => 5,
                'stockQuantity' => 680,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'productName' => 'Notebook A5',
                'price' => 40,
                'category_id' => 5,
                'stockQuantity' => 160,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'productName' => 'Eraser',
                'price' => 20,
                'category_id' => 4,
                'stockQuantity' => 300,
                'created_at' => '2025-02-12 00:00:00',
                'updated_at' => now(),
            ],
        ]);

        DB::table('stockHistory')->insert([
            [
                'product_id' => 1,
                'productName' => 'Coca Cola',
                'purchaseType' => 'Buy',
                'quantity' => 200,
                'totalQuantity' => 200,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'product_id' => 2,
                'productName' => 'Fanta',
                'purchaseType' => 'Buy',
                'quantity' => 200,
                'totalQuantity' => 200,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'product_id' => 3,
                'productName' => 'Sprite',
                'purchaseType' => 'Buy',
                'quantity' => 200,
                'totalQuantity' => 200,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'product_id' => 4,
                'productName' => 'Pepsi Cola',
                'purchaseType' => 'Buy',
                'quantity' => 180,
                'totalQuantity' => 180,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'product_id' => 5,
                'productName' => 'Mirinda',
                'purchaseType' => 'Buy',
                'quantity' => 280,
                'totalQuantity' => 280,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'product_id' => 6,
                'productName' => '7 UP',
                'purchaseType' => 'Buy',
                'quantity' => 180,
                'totalQuantity' => 180,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'product_id' => 7,
                'productName' => 'Cake',
                'purchaseType' => 'Buy',
                'quantity' => 20,
                'totalQuantity' => 20,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'product_id' => 8,
                'productName' => 'Bread',
                'purchaseType' => 'Buy',
                'quantity' => 60,
                'totalQuantity' => 60,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'product_id' => 9,
                'productName' => 'Banana',
                'purchaseType' => 'Buy',
                'quantity' => 60,
                'totalQuantity' => 60,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),


            ],
            [
                'product_id' => 10,
                'productName' => 'Cheese Burger',
                'purchaseType' => 'Buy',
                'quantity' => 12,
                'totalQuantity' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 11,
                'productName' => 'HP Envy',
                'purchaseType' => 'Buy',
                'quantity' => 37,
                'totalQuantity' => 37,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 12,
                'productName' => 'Samsung A15',
                'purchaseType' => 'Buy',
                'quantity' => 75,
                'totalQuantity' => 75,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 13,
                'productName' => 'Sony WH-CH520',
                'purchaseType' => 'Buy',
                'quantity' => 168,
                'totalQuantity' => 168,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 14,
                'productName' => 'Panadol',
                'purchaseType' => 'Buy',
                'quantity' => 360,
                'totalQuantity' => 360,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 15,
                'productName' => 'Zefcolin',
                'purchaseType' => 'Buy',
                'quantity' => 6,
                'totalQuantity' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 16,
                'productName' => 'Pencil x6',
                'purchaseType' => 'Buy',
                'quantity' => 680,
                'totalQuantity' => 680,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 17,
                'productName' => 'Pen x6',
                'purchaseType' => 'Buy',
                'quantity' => 680,
                'totalQuantity' => 680,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 18,
                'productName' => 'Notebook A5',
                'purchaseType' => 'Buy',
                'quantity' => 160,
                'totalQuantity' => 160,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 19,
                'productName' => 'Eraser',
                'purchaseType' => 'Buy',
                'quantity' => 300,
                'totalQuantity' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        // DB::table('sales')->create();
        // DB::table('salesDetail')->create();

        // DB::table('sales')->insert([
        //     [
        //         'totalQuantity' => 3,
        //         'totalPrice' => 1900.90,
        //         'payMethod' => 'Debit or Credit',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'totalQuantity' => 1,
        //         'totalPrice' => 199.99,
        //         'payMethod' => 'M-PESA',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'totalQuantity' => 3,
        //         'totalPrice' => 199.99,
        //         'payMethod' => 'Cash',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ]);
        // DB::table('salesDetail')->insert([
        //     [
        //         'sale_id' => 1,
        //         'product_id' => 1,
        //         'productName' => 'Laptop',
        //         'price' => 1200.99,
        //         'quantity' => 1,
        //     ],
        //     [
        //         'sale_id' => 1,
        //         'product_id' => 2,
        //         'productName' => 'Smartphone',
        //         'price' => 699.99,
        //         'quantity' => 2,
        //     ],
        //     [
        //         'sale_id' => 2,
        //         'product_id' => 3,
        //         'productName' => 'Headphones',
        //         'price' => 199.99,
        //         'quantity' => 1,
        //     ],
        //                                  [
        //         'sale_id' => 3,
        //         'product_id' => 3,
        //         'productName' => 'Headphones',
        //         'price' => 199.99,
        //         'quantity' => 3,
        //     ],
        // ]);
    }
}
