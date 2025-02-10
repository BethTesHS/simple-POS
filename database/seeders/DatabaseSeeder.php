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
        Schema::enableForeignKeyConstraints();
        
        // Insert sample data
        // date('Y-m-d H:i:s', strtotime('-5 days'));
        DB::table('categories')->insert([
            [
                'name' => 'Drink', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'name' => 'Food', 
                'created_at' => now(), 
                'updated_at' => now()
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
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'productName' => 'Fanta',
                'price' => 70,
                'category_id' => 1,
                'stockQuantity' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'productName' => 'Sprite',
                'price' => 70,
                'category_id' => 1,
                'stockQuantity' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'productName' => 'Pepsi Cola',
                'price' => 65,
                'category_id' => 1,
                'stockQuantity' => 180,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'productName' => 'Mirinda',
                'price' => 65,
                'category_id' => 1,
                'stockQuantity' => 180,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'productName' => '7 UP',
                'price' => 65,
                'category_id' => 1,
                'stockQuantity' => 180,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'productName' => 'Cake',
                'price' => 130,
                'category_id' => 2,
                'stockQuantity' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'productName' => 'Bread',
                'price' => 110,
                'category_id' => 2,
                'stockQuantity' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'productName' => 'Banana',
                'price' => 230,
                'category_id' => 2,
                'stockQuantity' => 60,
                'created_at' => now(),
                'updated_at' => now(),
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
