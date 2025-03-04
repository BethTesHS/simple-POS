<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use DB;
use Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// php artisan db:seed --class=DatabaseSeeder

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        DB::table('categories')->truncate();
        DB::table('products')->truncate();
        DB::table('sales')->truncate();
        DB::table('salesDetail')->truncate();
        DB::table('stockHistory')->truncate();
        DB::table('partialPayments')->truncate();
        Schema::enableForeignKeyConstraints();

        // Insert sample data
        // date('Y-m-d H:i:s', strtotime('-5 days'));
        DB::table('users')->insert([
            [
                'firstName' => 'Bethelhem',
                'lastName' => 'Tesfaye',
                'email' => 'BethelhemTesfaye95@gmail.com',
                'password' => Hash::make('21132113'),
                'role'=>'Buyer/Seller',
                'admin'=>true,
                'created_at' => now()->subDay()->subDay()
            ],
        ]);

        DB::table('users')->insert([
            [
                'firstName' => 'Raphael',
                'lastName' => 'Kathambana',
                'email' => 'maya12raph@gmail.com',
                'password' => Hash::make('12021202'),
                'role'=>'Seller',
                'admin'=>false,
                'created_at' => now()->subDay()->subDay()
            ],
        ]);

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
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay()
            ],
            [
                'name' => 'Pharmacy',
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay()
            ],
            [
                'name' => 'Stationary',
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay()
            ],
        ]);

        DB::table('products')->insert([
            [
                'productName' => 'Coca Cola',
                'price' => 70,
                'category_id' => 1,
                'stockQuantity' => 200,
                'created_at' => now()->subDay()->subDay(),
                'updated_at' => now()->subDay()->subDay(),
            ],
            [
                'productName' => 'Fanta',
                'price' => 70,
                'category_id' => 1,
                'stockQuantity' => 200,
                'created_at' => now()->subDay()->subDay(),
                'updated_at' => now()->subDay()->subDay(),
            ],
            [
                'productName' => 'Sprite',
                'price' => 70,
                'category_id' => 1,
                'stockQuantity' => 200,
                'created_at' => now()->subDay()->subDay(),
                'updated_at' => now()->subDay()->subDay(),
            ],
            [
                'productName' => 'Pepsi Cola',
                'price' => 65,
                'category_id' => 1,
                'stockQuantity' => 180,
                'created_at' => now()->subDay()->subDay(),
                'updated_at' => now()->subDay()->subDay(),
            ],
            [
                'productName' => 'Mirinda',
                'price' => 65,
                'category_id' => 1,
                'stockQuantity' => 180,
                'created_at' => now()->subDay()->subDay(),
                'updated_at' => now()->subDay()->subDay(),
            ],
            [
                'productName' => '7 UP',
                'price' => 65,
                'category_id' => 1,
                'stockQuantity' => 180,
                'created_at' => now()->subDay()->subDay(),
                'updated_at' => now()->subDay()->subDay(),
            ],
            [
                'productName' => 'Cake',
                'price' => 130,
                'category_id' => 2,
                'stockQuantity' => 20,
                'created_at' => now()->subDay()->subDay(),
                'updated_at' => now()->subDay()->subDay(),
            ],
            [
                'productName' => 'Bread',
                'price' => 110,
                'category_id' => 2,
                'stockQuantity' => 60,
                'created_at' => now()->subDay()->subDay(),
                'updated_at' => now()->subDay()->subDay(),
            ],
            [
                'productName' => 'Banana',
                'price' => 230,
                'category_id' => 2,
                'stockQuantity' => 60,
                'created_at' => now()->subDay()->subDay(),
                'updated_at' => now()->subDay()->subDay(),
            ],
            [
                'productName' => 'Cheese Burger',
                'price' => 1130,
                'category_id' => 2,
                'stockQuantity' => 12,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'productName' => 'HP Envy',
                'price' => 81200,
                'category_id' => 3,
                'stockQuantity' => 37,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'productName' => 'Samsung A15',
                'price' => 17000,
                'category_id' => 3,
                'stockQuantity' => 75,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'productName' => 'Sony WH-CH520',
                'price' => 4400,
                'category_id' => 3,
                'stockQuantity' => 168,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'productName' => 'Panadol',
                'price' => 200,
                'category_id' => 4,
                'stockQuantity' => 360,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'productName' => 'Zefcolin',
                'price' => 440,
                'category_id' => 4,
                'stockQuantity' => 6,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'productName' => 'Pencil x6',
                'price' => 120,
                'category_id' => 5,
                'stockQuantity' => 680,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'productName' => 'Pen x6',
                'price' => 200,
                'category_id' => 5,
                'stockQuantity' => 680,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'productName' => 'Notebook A5',
                'price' => 40,
                'category_id' => 5,
                'stockQuantity' => 160,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'productName' => 'Eraser',
                'price' => 20,
                'category_id' => 4,
                'stockQuantity' => 300,
                'created_at' => '2025-02-12 00:00:00',
                'updated_at' => now()->subDay(),
            ],
        ]);

        DB::table('stockHistory')->insert([
            [
                'product_id' => 1,
                'productName' => 'Coca Cola',
                'purchaseType' => 'Buy',
                'buyingPrice' => 50,
                'quantity' => 200,
                'totalQuantity' => 200,
                'created_at' => now()->subDay()->subDay(),
                'updated_at' => now()->subDay()->subDay(),
                'date' => now()->subDay()->subDay(),
                'user_id' => 1,
            ],
            [
                'product_id' => 2,
                'productName' => 'Fanta',
                'purchaseType' => 'Buy',
                'buyingPrice' => 50,
                'quantity' => 200,
                'totalQuantity' => 200,
                'created_at' => now()->subDay()->subDay(),
                'updated_at' => now()->subDay()->subDay(),
                'date' => now()->subDay()->subDay(),
                'user_id' => 1,
            ],
            [
                'product_id' => 3,
                'productName' => 'Sprite',
                'purchaseType' => 'Buy',
                'buyingPrice' => 50,
                'quantity' => 200,
                'totalQuantity' => 200,
                'created_at' => now()->subDay()->subDay(),
                'updated_at' => now()->subDay()->subDay(),
                'date' => now()->subDay()->subDay(),
                'user_id' => 1,
            ],
            [
                'product_id' => 4,
                'productName' => 'Pepsi Cola',
                'purchaseType' => 'Buy',
                'buyingPrice' => 45,
                'quantity' => 180,
                'totalQuantity' => 180,
                'created_at' => now()->subDay()->subDay(),
                'updated_at' => now()->subDay()->subDay(),
                'date' => now()->subDay()->subDay(),
                'user_id' => 1,
            ],
            [
                'product_id' => 5,
                'productName' => 'Mirinda',
                'purchaseType' => 'Buy',
                'buyingPrice' => 45,
                'quantity' => 280,
                'totalQuantity' => 280,
                'created_at' => now()->subDay()->subDay(),
                'updated_at' => now()->subDay()->subDay(),
                'date' => now()->subDay()->subDay(),
                'user_id' => 1,
            ],
            [
                'product_id' => 6,
                'productName' => '7 UP',
                'purchaseType' => 'Buy',
                'buyingPrice' => 45,
                'quantity' => 180,
                'totalQuantity' => 180,
                'created_at' => now()->subDay()->subDay(),
                'updated_at' => now()->subDay()->subDay(),
                'date' => now()->subDay()->subDay(),
                'user_id' => 1,
            ],
            [
                'product_id' => 7,
                'productName' => 'Cake',
                'purchaseType' => 'Buy',
                'buyingPrice' => 90,
                'quantity' => 20,
                'totalQuantity' => 20,
                'created_at' => now()->subDay()->subDay(),
                'updated_at' => now()->subDay()->subDay(),
                'date' => now()->subDay()->subDay(),
                'user_id' => 1,
            ],
            [
                'product_id' => 8,
                'productName' => 'Bread',
                'purchaseType' => 'Buy',
                'buyingPrice' => 90,
                'quantity' => 60,
                'totalQuantity' => 60,
                'created_at' => now()->subDay()->subDay(),
                'updated_at' => now()->subDay()->subDay(),
                'date' => now()->subDay()->subDay(),
                'user_id' => 1,
            ],
            [
                'product_id' => 9,
                'productName' => 'Banana',
                'purchaseType' => 'Buy',
                'buyingPrice' => 145,
                'quantity' => 60,
                'totalQuantity' => 60,
                'created_at' => now()->subDay()->subDay(),
                'updated_at' => now()->subDay()->subDay(),
                'date' => now()->subDay()->subDay(),
                'user_id' => 1,
            ],
            [
                'product_id' => 10,
                'productName' => 'Cheese Burger',
                'purchaseType' => 'Buy',
                'buyingPrice' => 900,
                'quantity' => 12,
                'totalQuantity' => 12,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
                'date' => now()->subDay(),
                'user_id' => 1,
            ],
            [
                'product_id' => 11,
                'productName' => 'HP Envy',
                'purchaseType' => 'Buy',
                'buyingPrice' => 70000,
                'quantity' => 37,
                'totalQuantity' => 37,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
                'date' => now()->subDay(),
                'user_id' => 1,
            ],
            [
                'product_id' => 12,
                'productName' => 'Samsung A15',
                'purchaseType' => 'Buy',
                'buyingPrice' => 10000,
                'quantity' => 75,
                'totalQuantity' => 75,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
                'date' => now()->subDay(),
                'user_id' => 1,
            ],
            [
                'product_id' => 13,
                'productName' => 'Sony WH-CH520',
                'purchaseType' => 'Buy',
                'buyingPrice' => 3000,
                'quantity' => 168,
                'totalQuantity' => 168,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
                'date' => now()->subDay(),
                'user_id' => 1,
            ],
            [
                'product_id' => 14,
                'productName' => 'Panadol',
                'purchaseType' => 'Buy',
                'buyingPrice' => 145,
                'quantity' => 360,
                'totalQuantity' => 360,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
                'date' => now()->subDay(),
                'user_id' => 1,
            ],
            [
                'product_id' => 15,
                'productName' => 'Zefcolin',
                'purchaseType' => 'Buy',
                'buyingPrice' => 345,
                'quantity' => 6,
                'totalQuantity' => 6,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
                'date' => now()->subDay(),
                'user_id' => 1,
            ],
            [
                'product_id' => 16,
                'productName' => 'Pencil x6',
                'purchaseType' => 'Buy',
                'buyingPrice' => 100,
                'quantity' => 680,
                'totalQuantity' => 680,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
                'date' => now()->subDay(),
                'user_id' => 1,
            ],
            [
                'product_id' => 17,
                'productName' => 'Pen x6',
                'purchaseType' => 'Buy',
                'buyingPrice' => 150,
                'quantity' => 680,
                'totalQuantity' => 680,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
                'date' => now()->subDay(),
                'user_id' => 1,
            ],
            [
                'product_id' => 18,
                'productName' => 'Notebook A5',
                'purchaseType' => 'Buy',
                'buyingPrice' => 15,
                'quantity' => 160,
                'totalQuantity' => 160,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
                'date' => now()->subDay(),
                'user_id' => 1,
            ],
            [
                'product_id' => 19,
                'productName' => 'Eraser',
                'purchaseType' => 'Buy',
                'buyingPrice' => 10,
                'quantity' => 300,
                'totalQuantity' => 300,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
                'date' => now()->subDay(),
                'user_id' => 1,
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
